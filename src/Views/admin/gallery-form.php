<?php require __DIR__ . '/layout-header.php'; ?>

<div class="card" style="max-width:620px;">
    <h2 style="color:#2d5a27; margin-bottom:22px;">
        <?= $action === 'create' ? '🖼️ Pridať fotografiu' : '✏️ Upraviť fotografiu' ?>
    </h2>

    <?php
    $formAction = $action === 'create'
        ? 'index.php?page=admin-gallery-create'
        : 'index.php?page=admin-gallery-edit&id=' . ($id ?? 0);
    ?>

    <form method="POST" action="<?= $formAction ?>"
          <?= $action === 'create' ? 'enctype="multipart/form-data"' : '' ?>>

        <div class="form-group">
            <label for="title">Názov fotografie *</label>
            <input type="text" id="title" name="title"
                   value="<?= htmlspecialchars($old['title'] ?? '') ?>" required>
            <?php if (!empty($errors['title'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['title']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Popis</label>
            <textarea id="description" name="description" rows="3"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
        </div>

        <?php if ($action === 'create'): ?>
        <div class="form-group">
            <label for="image">Obrázok (JPG, PNG, WEBP) *</label>
            <input type="file" id="image" name="image" accept="image/*" required style="padding:6px;">
            <?php if (!empty($errors['image'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['image']) ?></div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="form-group">
            <label>Aktuálna fotografia</label>
            <img src="<?= BASE_URL ?>/public/galeria/<?= htmlspecialchars($old['filename'] ?? '') ?>"
                 style="max-height:120px; border-radius:6px; display:block; margin-top:6px;">
        </div>
        <?php endif; ?>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">Poradie zobrazenia</label>
                <input type="number" id="sort_order" name="sort_order" min="0"
                       value="<?= (int)($old['sort_order'] ?? 0) ?>">
            </div>
            <div class="form-group" style="display:flex; align-items:flex-end; padding-bottom:4px;">
                <label style="display:flex; align-items:center; gap:8px; margin-bottom:0; cursor:pointer;">
                    <input type="checkbox" name="is_active" style="width:auto;"
                           <?= (!isset($old['is_active']) || $old['is_active']) ? 'checked' : '' ?>>
                    Aktívna (zobrazovať)
                </label>
            </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-green">
                <?= $action === 'create' ? '📤 Nahrať' : '💾 Uložiť' ?>
            </button>
            <a href="index.php?page=admin-gallery" class="btn btn-gray">Zrušiť</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/layout-footer.php'; ?>
