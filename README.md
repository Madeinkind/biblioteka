# Biblioteka

Веб-приложение для учёта библиотеки: книги, читатели, выдача книг, должники и посетители.

**Стек:** Vue 3 + Vue Router + Vuex (frontend, сборка webpack) и Lumen (PHP API) + SQLite.

## Требования

- Node.js 18+
- PHP 8.x с расширениями `pdo_sqlite`, `openssl`, `mbstring`
- Composer (для установки PHP-зависимостей)

## Установка и запуск

```bash
# 1. Зависимости frontend
npm install

# 2. Зависимости API
cd public/api
composer install

# 3. Настройки окружения
copy .env.example .env          # Windows
# cp .env.example .env          # Linux/macOS

# 4. JWT-ключи
php scripts/generate_jwt_keys.php

# 5. База данных SQLite
php database/init.php

# 6. Сборка frontend
cd ../..
npm run build

# 7. Запуск
start.bat                       # Windows (соберёт бандл при необходимости и откроет браузер)
# или вручную:
php -S localhost:8083 -t public
```

Приложение откроется на <http://localhost:8083/>.

## Вход

Логин и пароль администратора задаются в `public/api/.env`:

```
ADMIN_LOGIN=admin
ADMIN_PASSWORD=change_me
```

По умолчанию в примере указан `admin` / `change_me` — обязательно смените пароль.

## Структура

```
src/                исходники Vue-приложения
public/             статика, точка входа index.html, собранный bundle.js
public/api/         Lumen API (контроллеры, маршруты, SQLite-база)
public/api/database/schema.sql   схема SQLite
public/api/scripts/generate_jwt_keys.php
start.bat           запуск на Windows
```

## Примечания

- `public/bundle.js` собирается командой `npm run build` и не хранится в репозитории.
- Файл `public/api/.env` с секретами и локальная база `database.sqlite` в репозиторий не попадают.
- Если PHP не находит драйвер SQLite, включите `extension=pdo_sqlite` и `extension=sqlite3` в `php.ini`.
