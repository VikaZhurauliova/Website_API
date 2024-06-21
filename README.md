<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## О проекте
Это бекенд веб-сайта Market: REST API на Laravel + MySQL с документацией в Swagger

## Запуск на локальном окружении
Проект использует Laravel Sail, требующий Docker, но возможен запуск на любом локальном веб-сервере с поддержкой PHP 8.2 и MySQL 8.0

### Запуск при помощи Laravel Sail
1. Клонировать проект
2. Скопировать .env.example в .env: ```cp .env.example .env```
3. Выставить права на папку storage: ```chmod -R 777 storage```
4. Установить зависимости: ```composer install```
5. Создать алиас для sail: ```alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'```
6. Запустить docker-контейнер (docker должен быть предварительно запущен): ```sail up -d```
7. Войти в контейнер: ```sail root-shell```
8. Создать ключ для приложения: ```php artisan key:generate```
9. Создать ссылку из public на storage: ```php artisan storage:link```
10. Создать JWT ключ: ```php artisan jwt:secret```
11. Выполнить миграции: ```php artisan migrate``` После этого будет развёрнута структура БД с пустыми таблицами, поэтому логичнее просто импортировать БД с нужного прод-сайта.
12. Для заполнения БД на основе БД другого, ещё не обработанного, сайта можно использовать команды по аналогии с уже созданными в папке app/Console/Commands/import. Часть команд общая для всех БД, часть - индивидуальная. При помощи этих команд можно заполнить БД данного проекта на основе данных из других БД путём их обработки и преобразования. Порядок запуска команд указан в readme-файлах той же папки. 

В результате этих действий будет развёрнута апишка, документация к которой доступна по ссылке http://localhost:3007/api/documentation и phpMyAdmin, доступная по http://localhost:3009

Доступ к phpMyAdmin: mysql - root - password

### Команды sail:
1. Поднятие контейнера: ```sail up```
2. Тихое поднятие (с освобождением командной строки): ```sail up -d```
3. Вход внутрь контейнера: ```sail root-shell```
4. Выход из контейнера: ```exit```
5. Остановка контейнера: ```sail stop```
6. Остановка и удаление контейнера: ```docker-compose down --volumes```
7. Пересборка контейнера: ```sail up --build```
8. Импорт БД: ```docker exec -i atarashi-mysql-1 mysql -uroot -ppassword market_new < /path_to_db/mm_db.sql```

## Деплой
Запуск проекта на сервере выполняется точно так же, как на локальном окружении. Предварительно необходимо настроить DNS и Nginx для Laravel, подключить папку на сервере к репозиторию.

### Требования к серверу
1. Nginx
2. PHP 8.2
3. MySQL 8.0
4. Возможность настройки CRON
5. Supervisor для работы с очередями и возможность им управления (sudo-права)
6. Возможность настройки Nginx
7. Git
8. Zip
9. Composer
10. Imagick

### Необходимые расширения PHP
- php8.2-cli
- php8.2-dev
- php8.2-gd
- php8.2-imagick
- php8.2-curl
- php8.2-imap
- php8.2-mysql
- php8.2-mbstring
- php8.2-xml
- php8.2-zip
- php8.2-bcmath
- php8.2-soap
- php8.2-intl
- php8.2-readline
- php8.2-ldap

### Настройки PHP
- post_max_size = 100M
- upload_max_filesize = 100M

### Обновление кода из ГИТа
Для того, чтобы работало обновление кода по кнопке в админке, проект на сервере должен быть подключен к репозиторию по SSH. Кнопкой запускается набор команд, обновляющий фронт- и бек- проекты, выполняющий миграции и всё остальное, что требуется для обновления.
Обновить проект на сервере руками можно выполнив команду ```cd ~/path/to/api/folder && git checkout main --force && git pull && composer install && php artisan migrate --force``` где ~/path/to/api/folder - путь к папке проекта на сервере, привязанной к git-репозиторию.

## Документация и инструкции
- Laravel: https://laravel.com
- Swagger: https://github.com/DarkaOnLine/L5-Swagger , https://medium.com/@nelsonisioma1/how-to-document-your-laravel-api-with-swagger-and-php-attributes-1564fc11c305
- JWT: https://jwt-auth.readthedocs.io/en/develop/
- Intervention: https://intervention.io/
- GitHub Deploy with actions: https://www.programonaut.com/how-to-deploy-a-git-repository-to-a-server-using-github-actions/
- Supervisor: https://www.linode.com/docs/guides/how-to-install-and-configure-supervisor-on-centos-8/
