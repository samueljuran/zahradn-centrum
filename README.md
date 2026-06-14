# 🌿 Zelený Raj Záhrady – PHP Projekt

Školský projekt pre predmet **Skriptovacie jazyky**.  
Webstránka záhradníckej firmy realizovaná v čistom PHP 8.x bez frameworku.

---

## ✅ Splnené požiadavky

| Požiadavka | Splnené |
|---|---|
| OOP (triedy, dedičnosť, enkapsulácria) | ✅ |
| CRUD nad entitami (Služby + Galéria) | ✅ |
| PHP 8.0+ | ✅ |
| MySQL 8.0+ / MariaDB 10.5+ | ✅ |
| Bez PHP frameworku | ✅ |
| Bez CMS | ✅ |
| Autorizácia admina (bcrypt + sessions) | ✅ |
| PSR-4 autoloading | ✅ |
| Optimalizovaná DB schéma (FK, indexy, typy) | ✅ |
| Dynamické časti webu (DB-driven) | ✅ |

---

## 📁 Štruktúra projektu

```
zeleny_raj/
├── index.php                  ← Front Controller (vstupný bod)
├── config/
│   └── database.php           ← Konfigurácia DB pripojenia
├── database/
│   └── schema.sql             ← SQL schéma + vzorové dáta
├── public/
│   ├── style-zahrada.css
│   ├── script-zahrada.js
│   └── galeria/               ← Obrázky
└── src/
    ├── Core/
    │   ├── Database.php        ← PDO Singleton
    │   ├── Router.php          ← Front-controller router
    │   └── Auth.php            ← Session autentifikácia
    ├── Models/
    │   ├── BaseModel.php       ← Abstraktná základná trieda
    │   ├── ServiceModel.php    ← CRUD nad službami
    │   ├── GalleryModel.php    ← CRUD nad galériou
    │   ├── ContactModel.php    ← Správy z formulára
    │   └── UserModel.php       ← Autentifikácia admina
    ├── Controllers/
    │   ├── BaseController.php  ← Abstraktný controller
    │   ├── PublicController.php← Verejné stránky
    │   └── AdminController.php ← Admin CRUD
    └── Views/
        ├── partials/           ← header, footer
        ├── public/             ← home, services, gallery, contact
        └── admin/              ← login, dashboard, CRUD formuláre
```

---

## 🚀 Inštalácia

### 1. Požiadavky
- PHP 8.0+
- MySQL 8.0+ alebo MariaDB 10.5+
- Webserver (Apache / Nginx) alebo `php -S`

### 2. Databáza
```sql
-- Spusti v MySQL / phpMyAdmin:
SOURCE database/schema.sql;
```

### 3. Konfigurácia
Uprav `config/database.php`:
```php
return [
    'host'     => 'localhost',
    'dbname'   => 'zeleny_raj',
    'username' => 'root',      // tvoj MySQL používateľ
    'password' => '',          // tvoje heslo
];
```

### 4. Spustenie (lokálne bez Apache)
```bash
cd zeleny_raj
php -S localhost:8000
```
Otvor: http://localhost:8000

### 5. Prístup do administrácie
- URL: `http://localhost:8000/index.php?page=admin-login`
- Meno: `admin`
- Heslo: `admin123`

---

## 🏗️ Použité vzory a technológie

- **MVC** – Model-View-Controller
- **Singleton** – trieda `Database` (jedno DB spojenie)
- **Front Controller** – všetky požiadavky cez `index.php`
- **PSR-4** – autoloading tried bez Composera
- **PDO** – prepared statements (ochrana pred SQL Injection)
- **bcrypt** – `password_hash()` / `password_verify()` (ochrana hesiel)
- **Sessions** – PHP sessions pre admin autentifikáciu
- **`htmlspecialchars()`** – ochrana pred XSS vo všetkých výstupoch

---

## 📊 CRUD Operácie

### Služby (`services`)
| Operácia | Kde |
|---|---|
| **Create** | Admin → Pridať službu |
| **Read** | Verejná stránka Služby + Admin zoznam |
| **Update** | Admin → Upraviť službu |
| **Delete** | Admin → Vymazať službu |

### Galéria (`gallery_images`)
| Operácia | Kde |
|---|---|
| **Create** | Admin → Pridať fotografiu (upload) |
| **Read** | Verejná Galéria + Admin zoznam |
| **Update** | Admin → Upraviť metadáta |
| **Delete** | Admin → Vymazať fotografiu |
