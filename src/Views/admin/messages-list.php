<?php require __DIR__ . '/layout-header.php'; ?>

<?php $flash = \App\Core\FlashMessage::get(); ?>
<?php if ($flash): ?>
    <div class="flash flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<div class="card">
    <h2 style="color:#2d5a27; margin-bottom:20px;">✉️ Správy z kontaktného formulára</h2>

    <?php if (empty($messages)): ?>
        <p style="color:#888;">Žiadne správy.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Meno</th>
                <th>Email</th>
                <th>Správa</th>
                <th>Dátum</th>
                <th>Stav</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
            <tr style="<?= !$msg['is_read'] ? 'font-weight:600;' : '' ?>">
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td>
                    <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color:#3498db;">
                        <?= htmlspecialchars($msg['email']) ?>
                    </a>
                </td>
                <td style="max-width:280px; font-size:.85rem; white-space:pre-wrap; word-break:break-word;">
                    <?= htmlspecialchars(mb_substr($msg['message'], 0, 120)) ?>
                    <?= mb_strlen($msg['message']) > 120 ? '…' : '' ?>
                </td>
                <td style="white-space:nowrap; font-size:.83rem; color:#666;">
                    <?= date('d.m.Y H:i', strtotime($msg['created_at'])) ?>
                </td>
                <td>
                    <?= !$msg['is_read']
                        ? '<span class="badge badge-red">Nová</span>'
                        : '<span class="badge badge-gray">Prečítaná</span>' ?>
                </td>
                <td style="display:flex; gap:6px; flex-wrap:wrap;">
                    <?php if (!$msg['is_read']): ?>
                    <a href="index.php?page=admin-message-read&id=<?= $msg['id'] ?>"
                       class="btn btn-blue btn-sm">✅ Prečítaná</a>
                    <?php endif; ?>
                    <form method="POST" action="index.php?page=admin-message-delete"
                          onsubmit="return confirm('Naozaj vymazať túto správu?')">
                        <input type="hidden" name="id" value="<?= $msg['id'] ?>">
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
