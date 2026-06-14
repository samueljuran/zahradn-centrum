<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Zelený Raj Záhrady') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/style-zahrada.css">
    <style>
        .flash { padding: 12px 20px; border-radius: 6px; margin-bottom: 16px; font-weight: 500; }
        .flash-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .flash-error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-msg     { color: #dc3545; font-size: .875rem; margin-top: 4px; }
    </style>
</head>
<body>
<header id="main-header">
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="<?= BASE_URL ?>/public/galeria/pngtree-cartoon-cute-vector-shovel-icon-png-image_7115468.png"
                     alt="Logo Zelený Raj" class="logo-img">
            </a>
        </div>
        <button class="hamburger" aria-label="Otvoriť menu">&#9776;</button>
        <ul class="nav-links">
            <li><a href="index.php?page=home"     class="nav-item">Domov</a></li>
            <li><a href="index.php?page=services" class="nav-item">Naše Služby</a></li>
            <li><a href="index.php?page=gallery"  class="nav-item">Galéria</a></li>
            <li><a href="index.php?page=contact"  class="nav-item">Kontakt</a></li>
            <li><a href="index.php?page=admin-login" class="nav-item">👤 Prihlásiť sa</a></li>
        </ul>
    </nav>
</header>
<main>
