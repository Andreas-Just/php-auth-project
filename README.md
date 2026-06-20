# PHP Auth Project

A learning project: **user authentication** system built with PHP + SQLite.

> **Authentication** — verifying who you are (login + password).
> **Authorization** — verifying what you are allowed to do (access rights).
> This project focuses primarily on authentication.

## Features

- User login via credentials stored in a database (not hard-coded)
- Page protection — access denied without login
- Dashboard with user information
- Profile editing (name, email, bio)
- Logout with session destruction

## Tech Stack

- **PHP** — server-side logic
- **SQLite** — database (stored in a single file)
- **PDO** — PHP database connection layer
- **PHP Sessions** — tracking the authenticated user

## Project Structure

```
index.php          — login page (authentication)
dashboard.php      — main page after login
profile.php        — profile editing
logout.php         — logout
config/
  database.php     — SQLite connection via PDO
database/
  init.php         — table creation and test user seeding
css/
  style.css        — styles for all pages
```

## Getting Started

**1. Initialize the database:**
```bash
php database/init.php
```

**2. Start the built-in PHP server:**
```bash
php -S localhost:8000
```

**3. Open in your browser:**
```
http://localhost:8000
```

## Test User

| Field    | Value       |
|----------|-------------|
| Login    | `admin`     |
| Password | `secret123` |

## Key Concepts

| Concept | Where Used |
|---------|------------|
| `password_hash()` / `password_verify()` | Secure password storage |
| Prepared statements (`?`) | Protection against SQL injection |
| `htmlspecialchars()` | Protection against XSS attacks |
| `session_start()` / `$_SESSION` | Tracking the logged-in user |
| `CREATE TABLE IF NOT EXISTS` | Safe database initialization |
| `INSERT OR IGNORE` | Running init.php multiple times without errors |
