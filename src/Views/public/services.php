<?php require __DIR__ . '/../partials/header.php'; ?>

<section id="sluzby" class="section-padding">
    <h2>Kompletný cenník služieb</h2>
    <p>Ponúkame komplexnú starostlivosť od návrhu až po pravidelnú údržbu vášho exteriéru.</p>

    <?php if (empty($grouped)): ?>
        <p>Momentálne žiadne služby nie sú k dispozícii.</p>
    <?php else: ?>
        <?php foreach ($grouped as $category => $services): ?>
        <h3 style="text-transform:capitalize; color:#4a7c3f; margin-top:32px;">
            <?= htmlspecialchars(ucfirst($category)) ?>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>Názov</th>
                    <th>Popis</th>
                    <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <td data-label="Názov"><?= htmlspecialchars($service['name']) ?></td>
                    <td data-label="Popis"><?= htmlspecialchars($service['description']) ?></td>
                    <td data-label="Cena"><strong><?= number_format((float)$service['price'], 2) ?> €</strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="index.php?page=gallery" class="styled-button" style="margin-top:24px;">
        Pozrieť si Galériu realizácií
    </a>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
