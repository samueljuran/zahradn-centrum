<?php require __DIR__ . '/layout-header.php'; ?>

<?php $flash = \App\Core\FlashMessage::get(); ?>
<?php if ($flash): ?>
    <div class="flash flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="color:#2d5a27;">Zoznam služieb</h2>
        <a href="index.php?page=admin-service-create" class="btn btn-green">➕ Pridať novú</a>
    </div>

    <?php if (empty($services)): ?>
        <p style="color:#888;">Žiadne služby v databáze.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Názov</th>
                <th>Kategória</th>
                <th>Cena</th>
                <th>Stav</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><strong><?= htmlspecialchars($s['name']) ?></strong></td>
                <td><?= htmlspecialchars($s['category']) ?></td>
                <td><?= number_format((float)$s['price'], 2) ?> €</td>
                <td>
                    <?php if ($s['is_active']): ?>
                        <span class="badge badge-green">Aktívna</span>
                    <?php else: ?>
                        <span class="badge badge-gray">Skrytá</span>
                    <?php endif; ?>
                </td>
                <td style="display:flex; gap:6px; flex-wrap:wrap;">
                    <a href="index.php?page=admin-service-edit&id=<?= $s['id'] ?>"
                       class="btn btn-blue btn-sm">✏️ Upraviť</a>
                    <form method="POST" action="index.php?page=admin-service-delete"
                          onsubmit="return confirm('Naozaj vymazať túto službu?')">
                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                        <button type="submit" class="btn btn-red btn-sm">🗑️ Vymazať</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/layout-footer.php'; ?>
