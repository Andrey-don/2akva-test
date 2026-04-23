# CLAUDE.md — Инструкции для Claude Code

## Проект

**Сайт:** 2akva.ru — аквариумная тематика (водоочистка, инженерные решения)  
**Локальная копия:** 2akva-test.local (Local by Flywheel)  
**Рабочий сайт:** https://2akva.ru — не трогать!

## Среда разработки

- **Платформа:** Local by Flywheel, Windows 11
- **WordPress:** 6.9.4
- **PHP:** 8.3.29
- **Сервер:** Apache
- **База данных:** MySQL 5.7

### Подключение к БД (локально)
- Host: localhost
- Port: **10040**
- Database: local
- User: root / Password: root

### Пути
- WordPress root: `C:\Users\profi\Local Sites\2akva-test\app\public\`
- Конфиг Local: `C:\Users\profi\AppData\Roaming\Local\run\aKmtwXGHb\`
- PHP binary: `C:\Users\profi\AppData\Roaming\Local\lightning-services\php-8.3.29+1\bin\win64\php.exe`
- PHP ini: `C:\Users\profi\AppData\Roaming\Local\run\aKmtwXGHb\conf\php\php.ini`
- MySQL client: `C:\Users\profi\AppData\Roaming\Local\lightning-services\mysql-5.7.28+6\bin\win64\bin\mysql.exe`
- WP-CLI: `C:\Users\profi\AppData\Local\Programs\Local\resources\extraResources\bin\wp-cli\wp-cli.phar`

### Запуск WP-CLI
```powershell
$php = "C:\Users\profi\AppData\Roaming\Local\lightning-services\php-8.3.29+1\bin\win64\php.exe"
$phpini = "C:\Users\profi\AppData\Roaming\Local\run\aKmtwXGHb\conf\php\php.ini"
$wpcli = "C:\Users\profi\AppData\Local\Programs\Local\resources\extraResources\bin\wp-cli\wp-cli.phar"
$wppath = "C:\Users\profi\Local Sites\2akva-test\app\public"
& $php -c $phpini $wpcli <команда> --path="$wppath"
```

## Структура папок (только свой код)

```
wp-content/
  themes/
    2akva/              ← кастомная тема (Webflow-вёрстка)
      custom/
        menu_walker.php ← кастомный walker для навигации
        breadcumbs.php
        feature.php
      css/              ← стили (Webflow + кастомные)
      js/               ← скрипты (webflow.js, custom.js)
      functions.php     ← регистрация темы, скриптов, CPT
      *.php             ← шаблоны страниц
  plugins/              ← установленные плагины
```

## Что уже сделано

### Развёртывание бэкапа (2026-04-23)
- Импортирован дамп БД (`svladimail_2akva_mysql56_2026-04-23_15-29.sql.gz`)
- Скопировано 14 107 файлов сайта из `public_html_2026-04-23.zip`
- Выполнен `wp search-replace` — 2363 замены URL
- Восстановлены 629 медиафайлов из uploads

### Исправления
- **PHP Warning** в `menu_walker.php:29` — убрана неопределённая переменная `$item` в методе `start_lvl()`
- **jQuery в админке** — в `functions.php` добавлено `!is_admin()` к фильтру замены jQuery, чтобы CDN-версия работала только на фронтенде. Исправляет: пустую медиабиблиотеку, нерабочие вкладки Yoast, конфликт с Classic Editor

## Задачи (остались)

### 1. WP Mail SMTP — не отправляет письма
- За 30 дней не отправлено 397 писем
- Хостинг: Spaceweb
- Нужно диагностировать и настроить

### 2. Белый лист в блочном редакторе (Gutenberg)
- Контент создан в Classic Editor
- При переключении на Gutenberg — белый лист
- Нужно выяснить причину

## Правила работы

- Все изменения только на локальной копии (2akva-test)
- Рабочий сайт 2akva.ru не трогать
- Сначала диагностика, потом правки
- Перед изменением файла — показывать что и почему меняется
- **Не трогать:** `wp-config.php`, `uploads/`, `.htaccess` (без крайней необходимости)
