## Установка проекта

-   клонируем репозиторий `git clone https://tarasenkoevgenii@bitbucket.org/tarasenkoevgenii/cathedra.git`
-   создадим базу данных у себя в pma.
-   обновим файл .env прописав свои доступы для базы данных. Так же рекомендую устанвить занчение `APP_KEY=base64:frat1lWSZsroJxUSASyOjs5Tm6qUYbvdBl0tGC6T/GQ=` для того, чтобы не парится потом с ручной настройкой меню в админке и тестовых данных по другим таблицам, а воспользоваться дампом. так же в файле .env вам необходимо будет хранить токен для телеграмма (у кого задание по телеграмму) и использовать уже значение из файла .env, потому что у каждого из вас будет свой бот для тестирования и чтобы вы не мешали друг другу.
-   импортируем дамп базы данных, который я скину отдельно в телеграмме.
-   переходим в директорию с проектом
-   устанавливаем зависемости php `composer update`
-   выполним `php artisan migrate`, чтобы убедиться, что все миграции выполнены и после создания дампа ничего больше не было добавлено.
-   так же напомню, что нужно установить рут-директорию в опен сервере на папку /public, но это вы и сами должны помнить.
-   сразу установим зависемости npm (вы можете этого не делать, но это необходимо, чтобы у вас работали все модуля, которые уже написаны на vue и если вы будете сами писать компоненты на vue, что было бы здорово, но не обязательно). убеждаемся что установлен node.js - пишем в консоли npm - если команада не найдена - устанвливаем ноду отсюда https://nodejs.org/uk/ . Если установлена выполняем `npm intsall` и после этого сделаем сборку `npm run dev`. Обратите внимание, что npm может быть не виден с консоли опенсервера, попробуйте через стандартную консоль.

Доступы в админку: admin / admin

Так же хочу обратить внимание, что исходные файлы html-шаблона находятся в конре в папке template. Их можно использовать для своей работы.

Админ часть делаем внутри админки согласно пакету `"encore/laravel-admin"`. Если внимательно почитать документацию, то вы можете полностью управлять содержимым страницы, выводить туда свои представления и прочее. Желаельно сохранить общую шапку и меню в своих шаблонах. В остальном вы имеете полную свободу действий каким образом и с помощью чего вы будете реализовывать свои модуля.

Телеграм бот делаем на основе пакета `"botman/botman": "^2.4"`. Для прослушивания сообщений пользователя можно пользоваться тунелями от https://ngrok.com/ . Открываем тунель - получаем https урл нашей локалки, который виден в сети - привязываем свой бот к этому урлу согласно https://botman.io/2.0/driver-telegram (см. Register Your Webhook) - пользуемся и радуемся.

Приветсвуется ипользование готовых решений в виде пакетов.

Работу ведем каждый в своей ветке. Команда по разработке телеграм бота - наймнование ветки telegram_bot, команда по онлайн-журналу - online_journal. Если что ветки уже созданы)

// Test
