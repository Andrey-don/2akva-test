# CLAUDE.md — Инструкции для Claude Code

## Проект

**Сайт:** 2akva.ru — ООО «2Н АКВА», водоочистка, насосное оборудование, дренаж (бренд 2H GEOdek)
**Контактный e-mail:** info@2akva.ru
**Локальная копия:** http://2akva-test.local (Local by Flywheel)
**Рабочий сайт:** https://2akva.ru — **не трогать!**

## Среда разработки

- **Платформа:** Local by Flywheel, Windows 11
- **WordPress:** 6.9.4
- **PHP:** 8.3.29
- **Сервер:** Apache
- **База данных:** MySQL 5.7

### Хостинг (продакшн)
- Провайдер: Sweb.ru (SpaceWeb), панель: cp.sweb.ru
- IP: 77.222.62.59
- PHP: 8.3, MySQL: 8.0

### Подключение к БД (локально)
- Host: localhost, Port: **10040**
- Database: `local`, User: `root` / Password: `root`

### Пути (локально)
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

## DNS и почта (КРИТИЧНО — не менять!)

| Запись | Значение | Назначение |
|--------|----------|------------|
| MX | `mx.yandex.net` (приоритет 10) | **НЕ МЕНЯТЬ!** Входящая почта сотрудников через Яндекс 360 |
| SPF | `v=spf1 include:_spf.yandex.net include:spaceweb.ru ~all` | Авторизация серверов отправки |
| DKIM | `sweb._domainkey` (TXT) | Цифровая подпись Spaceweb |
| DMARC | `v=DMARC1; p=none; rua=mailto:info@2akva.ru` | Политика проверки |

**Инцидент март 2026:** при настройке SMTP MX-запись была ошибочно переключена на Spaceweb → 2 дня сотрудники не получали почту. Восстановлена на Яндекс 360. MX не трогать никогда.

## Плагины (активные)

| Плагин | Назначение |
|--------|------------|
| Advanced Custom Fields + ACF Repeater | Кастомные поля, блоки на главной |
| Yoast SEO | SEO, sitemap.xml |
| WP Mail SMTP | Исходящая почта через Spaceweb SMTP |
| Contact Form 7 | Формы (From/To: info@2akva.ru) |
| Classic Editor | Редактор записей |
| Duplicator | Бэкапы (держать, но не активировать постоянно) |
| Really Simple Security | **НЕ активировать локально** — блокирует доступ |
| WP Super Cache | Кэширование |
| WP File Manager | Файловый менеджер в админке |
| WPForms Lite | Дополнительные формы |
| wp-media-folders | Папки в медиабиблиотеке |

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
- Выполнен `wp search-replace` — 2363 замены URL (https://2akva.ru → http://2akva-test.local)
- Восстановлены 629 медиафайлов из uploads

### Исправления в коде
- **PHP Warning** в `wp-content/themes/2akva/custom/menu_walker.php:29` — убрана неопределённая переменная `$item` в методе `start_lvl()` (несовместимость с PHP 8.x)
- **jQuery в админке** — в `functions.php` добавлено `!is_admin()` к фильтру замены jQuery 4.0→3.7.1, чтобы CDN-версия применялась только на фронтенде. Исправляет: пустую медиабиблиотеку, нерабочие вкладки Yoast SEO, конфликт с Classic Editor

### Активация плагинов (2026-04-23)
Активированы через WP-CLI: `duplicator`, `wp-file-manager`, `wpforms-lite`, `wp-mail-smtp`, `wp-super-cache`, `yandex-metrica`. Really Simple Security оставлен неактивным.

## Задачи (в работе)

### 1. WP Mail SMTP — не отправляет письма ⚠️
**Симптом:** за 30 дней не отправлено 397 писем.

**Диагностика:**
- В БД (`wp_options`, ключ `wp_mail_smtp`): mailer = `mail` (PHP mail() — не работает на Spaceweb)
- SMTP-раздел в БД пустой: host, port, login, password не заданы
- Вывод: настройки SMTP, вероятно, хранились как **константы в `wp-config.php`** на продакшне (не пишутся в БД) и не попали в дамп

**Как должно быть настроено (Spaceweb SMTP):**
- Mailer: `smtp`
- Host: `smtp.spaceweb.ru`
- Port: `465` (SSL) или `587` (TLS)
- Username: `info@2akva.ru`
- Password: пароль от ящика (взять в cp.sweb.ru)
- **MX не трогать** — SMTP только для исходящей почты с сайта

**Следующий шаг:** получить пароль от info@2akva.ru в панели Spaceweb и настроить WP Mail SMTP на рабочем сайте.

### 2. Белый лист в блочном редакторе (Gutenberg)
- Контент создан в Classic Editor
- При переключении на Gutenberg — белый лист
- Нужно выяснить причину

## Важные предупреждения

- **MX-запись** — НЕ менять `mx.yandex.net`. Все сотрудники используют Яндекс 360 (@2akva.ru).
- **wp-includes/class-wp-query.php** — содержит ручное исправление строка 756 (`intval()`). При обновлении WordPress — внести правку повторно.
- **jQuery** — в `functions.php` фильтр замены jQuery 4.0 → 3.7.1 (CDN, только фронтенд). При обновлении темы — проверить наличие.
- **Really Simple Security** — не активировать локально, блокирует доступ к сайту.

## Правила работы

- Все изменения только на локальной копии (2akva-test)
- Рабочий сайт 2akva.ru не трогать
- Сначала диагностика, потом правки
- Перед изменением файла — показывать что и почему меняется
- **Не трогать:** `wp-config.php` (DB_* константы), `uploads/`, `.htaccess` (без крайней необходимости)
