<?php require __DIR__ . '/layout-header.php'; ?>

<div class="stats">
    <div class="stat">
        <div class="stat-num"><?= $serviceCount ?></div>
        <div class="stat-label">Celkom služieb</div>
    </div>
    <div class="stat">
        <div class="stat-num"><?= $galleryCount ?></div>
        <div class="stat-label">Fotografií v galérii</div>
    </div>
    <div class="stat">
        <div class="stat-num"><?= $messageCount ?></div>
        <div class="stat-label">Správ z formulára</div>
    </div>
    <div class="stat">
        <div class="stat-num" style="color:<?= $unreadCount > 0 ? '#e74c3c' : '#2d5a27' ?>">
            <?= $unreadCount ?>
        </div>
        <div class="stat-label">Neprečítaných správ</div>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom:16px; color:#2d5a27;">Rýchle akcie</h2>
    <div style="display:flex; gap:12px; flex-wrap:wrap;">
        <a href="index.php?page=admin-service-create" class="btn btn-green">➕ Pridať službu</a>
        <a href="index.php?page=admin-gallery-create" class="btn btn-blue">🖼️ Pridať fotografiu</a>
        <a href="index.php?page=admin-messages"        class="btn btn-gray">✉️ Zobraziť správy</a>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom:4px; color:#2d5a27;">O projekte</h2>
    <p style="color:#666; font-size:.9rem; margin-top:8px;">
        Administračné rozhranie pre webstránku <strong>Zelený Raj Záhrady</strong>.
        Projekt realizovaný v čistom PHP 8.x s použitím OOP, MVC vzoru, PDO a bcrypt hashovania hesiel.
    </p>
</div>

<?php require __DIR__ . '/layout-footer.php'; ?>
