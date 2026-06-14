<?php require __DIR__ . '/../partials/header.php'; ?>

<section id="galeria" class="section-padding">
    <h2>Galéria našich realizácií</h2>
    <p>Pozrite si ukážky našej práce — od návrhu až po hotovú záhradu.</p>

    <?php if (empty($images)): ?>
        <p>Galéria je momentálne prázdna.</p>
    <?php else: ?>
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; margin-top:24px;">
        <?php foreach ($images as $img): ?>
        <div style="border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.12);">
            <img src="<?= BASE_URL ?>/public/galeria/<?= htmlspecialchars($img['filename']) ?>"
                 alt="<?= htmlspecialchars($img['title']) ?>"
                 style="width:100%; height:220px; object-fit:cover; display:block;">
            <div style="padding:12px; background:#fff;">
                <strong><?= htmlspecialchars($img['title']) ?></strong>
                <?php if (!empty($img['description'])): ?>
                <p style="font-size:.85rem; color:#666; margin:4px 0 0;"><?= htmlspecialchars($img['description']) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <a href="index.php?page=contact" class="styled-button" style="margin-top:32px;">
        Chcem si objednať záhradu
    </a>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
