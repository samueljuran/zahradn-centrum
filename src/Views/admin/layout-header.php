<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin') ?></title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body   { font-family: 'Segoe UI', sans-serif; background: #f0f4f0; color: #333; display: flex; min-height: 100vh; }

        
        .sidebar { width: 240px; background: #2d5a27; color: #fff; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-logo { padding: 24px 20px; font-size: 1.2rem; font-weight: 700; border-bottom: 1px solid #3d7a35; }
        .sidebar-logo span { font-size: .75rem; display: block; color: #a8d5a2; margin-top: 2px; }
        .sidebar nav a {
            display: block; padding: 12px 20px; color: #cce8c8; text-decoration: none;
            font-size: .92rem; border-left: 3px solid transparent; transition: .15s;
        }
        .sidebar nav a:hover, .sidebar nav a.active { background: #3d7a35; color: #fff; border-left-color: #8fca87; }
        .sidebar-footer { margin-top: auto; padding: 16px 20px; font-size: .8rem; color: #8fca87; border-top: 1px solid #3d7a35; }

        
        .admin-main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .admin-topbar {
            background: #fff; padding: 16px 28px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 1px 4px rgba(0,0,0,.08);
        }
        .admin-topbar h1 { font-size: 1.15rem; color: #2d5a27; }
        .admin-topbar a  { color: #888; text-decoration: none; font-size: .88rem; }
        .admin-topbar a:hover { color: #c0392b; }
        .content { padding: 28px; flex: 1; overflow-y: auto; }

        
        .card   { background: #fff; border-radius: 10px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,.07); margin-bottom: 20px; }
        .stats  { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .stat   { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,.07); text-align: center; }
        .stat-num  { font-size: 2.2rem; font-weight: 700; color: #2d5a27; }
        .stat-label { font-size: .85rem; color: #777; margin-top: 4px; }

        table  { width: 100%; border-collapse: collapse; font-size: .9rem; }
        th     { background: #f0f4f0; color: #2d5a27; padding: 10px 14px; text-align: left; font-weight: 600; }
        td     { padding: 10px 14px; border-bottom: 1px solid #eee; vertical-align: middle; }
        tr:hover td { background: #fafdf9; }

        
        .btn        { display: inline-block; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: .875rem; font-weight: 500; border: none; cursor: pointer; transition: .15s; }
        .btn-green  { background: #2d5a27; color: #fff; }
        .btn-green:hover  { background: #3d7a35; }
        .btn-blue   { background: #3498db; color: #fff; }
        .btn-blue:hover   { background: #2980b9; }
        .btn-red    { background: #e74c3c; color: #fff; }
        .btn-red:hover    { background: #c0392b; }
        .btn-gray   { background: #95a5a6; color: #fff; }
        .btn-gray:hover   { background: #7f8c8d; }
        .btn-sm     { padding: 5px 10px; font-size: .8rem; }

        
        .form-group    { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; font-size: .88rem; }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%; padding: 9px 12px; border: 1px solid #ccc; border-radius: 6px;
            font-size: .9rem; font-family: inherit;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus { outline: none; border-color: #4a7c3f; box-shadow: 0 0 0 3px rgba(74,124,63,.15); }
        .form-row  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        
        .flash         { padding: 12px 18px; border-radius: 6px; margin-bottom: 20px; font-size: .9rem; }
        .flash-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .flash-error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .error-msg { color: #e74c3c; font-size: .8rem; margin-top: 4px; }
        .badge     { display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .badge-green { background: #d4edda; color: #155724; }
        .badge-gray  { background: #e9ecef; color: #555; }
        .badge-red   { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        🌿 Zelený Raj
        <span>Administrácia</span>
    </div>
    <nav>
        <a href="index.php?page=admin-dashboard" <?= (($_GET['page'] ?? '') === 'admin-dashboard') ? 'class="active"' : '' ?>>📊 Dashboard</a>
        <a href="index.php?page=admin-services"  <?= str_starts_with($_GET['page'] ?? '', 'admin-service') ? 'class="active"' : '' ?>>🌱 Správa služieb</a>
        <a href="index.php?page=admin-gallery"   <?= str_starts_with($_GET['page'] ?? '', 'admin-gallery') ? 'class="active"' : '' ?>>🖼️ Galéria</a>
        <a href="index.php?page=admin-messages"  <?= str_starts_with($_GET['page'] ?? '', 'admin-message') ? 'class="active"' : '' ?>>✉️ Správy</a>
        <a href="index.php?page=home" target="_blank">🌐 Zobraziť web</a>
    </nav>
    <div class="sidebar-footer">
        Prihlásený: <strong><?= htmlspecialchars(\App\Core\Auth::getUsername()) ?></strong><br>
        <a href="index.php?page=admin-logout" style="color:#f9a8a8;">Odhlásiť sa</a>
    </div>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <h1><?= htmlspecialchars($title ?? 'Admin') ?></h1>
        <a href="index.php?page=admin-logout">⏻ Odhlásiť</a>
    </div>
    <div class="content">
