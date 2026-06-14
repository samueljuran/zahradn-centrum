# 🌿 Zelený Raj Záhrady – PHP Projekt

Školský projekt pre predmet **Skriptovacie jazyky**.  
Webstránka záhradníckej firmy realizovaná v čistom PHP 8.x bez frameworku.


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


 5. Prístup do administrácie
- URL: `http://localhost:8000/index.php?page=admin-login`
- Meno: `admin`
- Heslo: `admin123`

---




