# Student Portal — Личный кабинет студента

Учебный full-stack проект: **PHP + MySQL (Back-end)**, структурированный по **DevOps**-практикам (Git/GitHub/CI), с элементами **CMS**-подхода (роли пользователей, админ-панель).

## Технологии

| Слой | Стек |
|---|---|
| Front-end | HTML5, CSS3, JavaScript |
| Back-end | PHP 8, MySQLi (prepared statements) |
| База данных | MySQL / MariaDB |
| Локальная среда | XAMPP (Apache + MySQL + PHP) |
| DevOps | Git, GitHub, GitHub Actions (CI) |

## Функциональность

- Регистрация и авторизация (хеширование паролей через `password_hash`/`password_verify`)
- Сессии (`$_SESSION`) для разграничения доступа
- Личный кабинет студента: профиль, список дисциплин и оценок
- Роль `admin`: отдельная админ-панель со списком пользователей
- Защита от SQL-инъекций через подготовленные запросы (prepared statements)
- Защита от XSS через `htmlspecialchars()` при выводе данных

## Структура проекта

```
student_portal/
├── index.php              # главная страница
├── login.php               # авторизация
├── register.php            # регистрация
├── profile.php              # личный кабинет
├── admin.php                # админ-панель (роль admin)
├── logout.php               # выход из системы
├── config/
│   ├── database.php         # подключение к БД
│   └── database.sql         # SQL-схема + тестовые данные
├── includes/
│   ├── header.php            # общая шапка
│   ├── footer.php             # общий подвал
│   └── flash.php               # вывод сообщений об ошибках/успехе
├── actions/
│   ├── process_login.php      # обработка входа
│   └── process_register.php   # обработка регистрации
├── assets/
│   ├── css/style.css           # минималистичные стили (тёмная тема)
│   └── js/script.js            # клиентская валидация
├── .github/workflows/deploy.yml # CI: проверка PHP-синтаксиса
└── .gitignore
```

## Настройка XAMPP (пошагово)

1. **Скачать и установить XAMPP** с [apachefriends.org](https://www.apachefriends.org).
2. **Скопировать проект** в папку `xampp/htdocs/student_portal/` (на Windows обычно `C:\xampp\htdocs\`).
3. **Запустить XAMPP Control Panel** и нажать `Start` напротив `Apache` и `MySQL`.
4. **Создать базу данных**:
   - Открыть [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Вкладка `SQL` → вставить содержимое `config/database.sql` → `Go`
   - Либо: `Databases` → создать `student_portal` вручную и импортировать файл через вкладку `Import`
5. **Проверить подключение**: в `config/database.php` уже настроены стандартные для XAMPP данные (`root` без пароля). Если у вас задан пароль MySQL — впишите его в переменную `$password`.
6. **Открыть проект в браузере**: [http://localhost/student_portal/](http://localhost/student_portal/)
7. **Проверить работу**: зарегистрировать пользователя → войти → увидеть профиль.

Чтобы сделать пользователя администратором, откройте `phpMyAdmin` → таблица `users` → измените поле `role` на `admin` для нужной записи.

## Git и GitHub

```bash
git init
git add .
git commit -m "Initial commit: student portal project"
git branch -M main
git remote add origin https://github.com/<your-username>/student-portal.git
git push -u origin main
```

При каждом `push` в `main` автоматически запускается workflow `.github/workflows/deploy.yml`, который проверяет синтаксис всех PHP-файлов (`php -l`) — это базовый CI-контроль качества кода.

## Безопасность (соответствует темам SMS/CMS)

- Пароли хранятся только в виде хеша (`password_hash`)
- Все SQL-запросы — через `mysqli_prepare` (защита от SQL Injection)
- Весь пользовательский вывод экранируется `htmlspecialchars()` (защита от XSS)
- Конфигурация БД вынесена в отдельный файл `config/database.php`, который стоит добавлять в `.gitignore` при использовании реальных паролей
- Разграничение ролей (`student` / `admin`) ограничивает доступ к `admin.php`

## Запуск локально одной командой (без XAMPP)

Если XAMPP не нужен, можно поднять встроенный сервер PHP:

```bash
cd student_portal
php -S localhost:8000
```

Проект откроется на [http://localhost:8000](http://localhost:8000) (потребуется отдельно настроенная MySQL/MariaDB).
