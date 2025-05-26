# ETIMAX

## Установка проекта

1. Клонируйте репозиторий:
```bash
git clone <url-репозитория>
cd etimax
```

2. Запустите Laravel Sail:
```bash
./vendor/bin/sail up -d
```

3. Войдите в контейнер:
```bash
./vendor/bin/sail shell
```

4. Установите зависимости:
```bash
composer install
```

5. Скопируйте файл окружения:
```bash
cp .env.example .env
```

6. Сгенерируйте ключ приложения:
```bash
php artisan key:generate
```

7. Настройте подключение к базе данных в файле .env:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

8. Запустите миграции:
```bash
php artisan migrate
```

9. Создайте символическую ссылку для хранения файлов:
```bash
php artisan storage:link
```

10. Запустите сидеры:
```bash
php artisan db:seed
```

## Доступ к админ-панели

После установки вы можете войти в админ-панель (/admin) используя следующие учетные данные:

- Email: admin@test.com
- Password: password

## Разработка

1. Запустите сборку фронтенда (внутри контейнера):
```bash
npm install
npm run dev
```

2. Приложение будет доступно по адресу:
```
http://localhost
```

## Полезные команды Sail

- Запуск контейнеров: `./vendor/bin/sail up -d`
- Остановка контейнеров: `./vendor/bin/sail down`
- Вход в контейнер: `./vendor/bin/sail shell`
- Запуск команд artisan: `./vendor/bin/sail artisan`
- Запуск composer: `./vendor/bin/sail composer`
- Запуск npm: `./vendor/bin/sail npm` 
