<?php

namespace App\Admin\Controllers;

use App\Models\CathedraInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class CathedraInfoControllers extends Controller
{

    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('О кафедре')
            ->description('наша кафедра')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {   
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CathedraInfo);

        $grid->id('Ид');
        $grid->caption('Заголовок')->sortable();;
        $grid->answer('Сообщение');
        $grid->image('Изображение')->display(function ($id) {
            if (isset($id)) {
                return '<a href="/admin/media?path=' . urlencode('/uploads/' . $id) . '">Просмотреть</a>';
            } else {
                return '-';
            }
        });
        $grid->active('Статус')->sortable();;
        $grid->created_at('Дата создания')->sortable();;
        $grid->updated_at('Дата редактирования')->sortable();;

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CathedraInfo::findOrFail($id));

        $show->id('Ид');
        $show->caption('Заголовок');
        $show->answer('Сообщение');
        $show->image('Изображение');
        $show->active('Статус');
        $show->created_at('Дата создания');
        $show->updated_at('Дата редактирования');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CathedraInfo);

        $form->text('caption', 'Заголовок')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('answer', 'Сообщение')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->image('image', 'Изображение')->rules('image', [
            'image' => 'Это должна быть картинка',
        ]);
        $form->switch('active', 'Статус')->default(1);
        $form->saved(function (Form $form) {
            $path = storage_path('/app/public/uploads' . $form->model()->id);
            dump($path);
            if(!file_exists($path)) {
                mkdir($path);
            }   
        });

        //подключаемся к бд
        $link = mysqli_connect("localhost", "root", "", "telegram_bot");

        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Соединение не удалось: %s\n", mysqli_connect_error());
            exit();
        }

        if ($result = mysqli_query($link, "SELECT * FROM cathedra_info WHERE active = 1")) {

            /* определение числа рядов в выборке */
            if ($row_cnt = mysqli_num_rows($result) >= 5) {
                // redirect back with an error message
                $form->saving(function ($form) {

                    $error = new MessageBag([
                        'title'   => 'Ошибка',
                        'message' => 'Максимальное количество активных записей 5. ',
                    ]);

                    return redirect('/admin/cathedra-info')->with(compact('error'));
                });
            }
            /* закрытие выборки */
            mysqli_free_result($result);
        }

        return $form;       
    }
}
