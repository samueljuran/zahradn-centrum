<?php require __DIR__ . '/layout-header.php'; ?>

<div class="card" style="max-width:680px;">
    <h2 style="color:#2d5a27; margin-bottom:22px;">
        <?= $action === 'create' ? '➕ Pridať novú službu' : '✏️ Upraviť službu' ?>
    </h2>

    <?php
    $formAction = $action === 'create'
        ? 'index.php?page=admin-service-create'
        : 'index.php?page=admin-service-edit&id=' . ($id ?? 0);
    ?>

    <form method="POST" action="<?= $formAction ?>">

        <div class="form-group">
            <label for="name">Názov služby *</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Popis *</label>
            <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            <?php if (!empty($errors['description'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['description']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price">Cena (€) *</label>
                <input type="number" id="price" name="price" min="0" step="0.01"
                       value="<?= htmlspecialchars((string)($old['price'] ?? '0')) ?>" required>
                <?php if (!empty($errors['price'])): ?>
                    <div class="error-msg"><?= htmlspecialchars($errors['price']) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="category">Kategória *</label>
                <input type="text" id="category" name="category"
                       value="<?= htmlspecialchars($old['category'] ?? '') ?>"
                       list="category-list" required>
                <datalist id="category-list">
                    <option value="údržba">
                    <option value="návrh">
                    <option value="výsadba">
                    <option value="inštalácia">
                    <option value="balík">
                    <option value="ostatné">
                </datalist>
                <?php if (!empty($errors['category'])): ?>
                    <div class="error-msg"><?= htmlspecialchars($errors['category']) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group" style="display:flex; align-items:center; gap:10px;">
            <input type="checkbox" id="is_active" name="is_active" style="width:auto;"
                   <?= (!isset($old['is_active']) || $old['is_active']) ? 'checked' : '' ?>>
            <label for="is_active" style="margin-bottom:0;">Aktívna (zobrazovať na webe)</label>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-green">
                <?= $action === 'create' ? '➕ Pridať' : '💾 Uložiť zmeny' ?>
            </button>
            <a href="index.php?page=admin-services" class="btn btn-gray">Zrušiť</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/layout-footer.php'; ?>
