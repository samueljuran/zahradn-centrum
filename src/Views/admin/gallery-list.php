<?php require __DIR__ . '/layout-header.php'; ?>

<?php $flash = \App\Core\FlashMessage::get(); ?>
<?php if ($flash): ?>
    <div class="flash flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="color:#2d5a27;">Galéria fotografií</h2>
        <a href="index.php?page=admin-gallery-create" class="btn btn-green">➕ Pridať fotografiu</a>
    </div>

    <?php if (empty($images)): ?>
        <p style="color:#888;">Galéria je prázdna.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Náhľad</th>
                <th>Názov</th>
                <th>Popis</th>
                <th>Poradie</th>
                <th>Stav</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $img): ?>
            <tr>
                <td>
                    <img src="<?= BASE_URL ?>/public/galeria/<?= htmlspecialchars($img['filename']) ?>"
                         alt="<?= htmlspecialchars($img['title']) ?>"
                         style="width:70px; height:50px; object-fit:cover; border-radius:4px;">
                </td>
                <td><strong><?= htmlspecialchars($img['title']) ?></strong></td>
                <td style="font-size:.83rem; color:#666; max-width:200px;">
                    <?= htmlspecialchars(mb_substr($img['description'] ?? '', 0, 60)) ?>…
                </td>
                <td><?= (int)$img['sort_order'] ?></td>
                <td>
                    <?= $img['is_active']
                        ? '<span class="badge badge-green">Aktívna</span>'
                        : '<span class="badge badge-gray">Skrytá</span>' ?>
                </td>
                <td style="display:flex; gap:6px;">
                    <a href="index.php?page=admin-gallery-edit&id=<?= $img['id'] ?>"
                       class="btn btn-blue btn-sm">✏️ Upraviť</a>
                    <form method="POST" action="index.php?page=admin-gallery-delete"
                          onsubmit="return confirm('Naozaj vymazať túto fotografiu?')">
                        <input type="hidden" name="id" value="<?= $img['id'] ?>">
                        <button type="submit" class="btn btn-red btn-sm">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/layout-footer.php'; ?>
