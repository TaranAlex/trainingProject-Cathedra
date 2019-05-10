<?php

namespace App\Admin\Controllers;

use App\Http\Requests\CheckPointRequest;
use App\Models\CheckPoint;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CheckPointController extends Controller
{
    public function store(CheckPointRequest $request)
    {
        $checkpoint = new CheckPoint();

        $checkpoint->name = $request->name;
        $checkpoint->max_point = $request->max_point;
        $checkpoint->date = $request->date;
        $checkpoint->deadline = $request->deadline;
        $checkpoint->journal_id = $request->journal_id;

        $checkpoint->save();

        return redirect(route('journal', $request->journal_id));
    }

    public function edit($id)
    {
        $checkpoint = CheckPoint::findOrFail($id);

        return view('admin.online-journal.edit', compact('checkpoint'));
    }

    public function update(CheckPointRequest $request, $id)
    {
        $checkpoint = CheckPoint::findOrFail($id);

        $checkpoint->name = $request->name;
        $checkpoint->max_point = $request->max_point;
        $checkpoint->date = $request->date;
        $checkpoint->deadline = $request->deadline;
        $checkpoint->journal_id = $request->journal_id;

        $checkpoint->save();

        return redirect(route('journal', $request->journal_id));
    }

    public function destroy($id)
    {
        dd(1);
        $checkpoint = CheckPoint::findOrFail($id)->delete();

        return redirect()->back();
    }
}
