<?php require __DIR__ . '/../partials/header.php'; ?>

<section id="home" class="section-padding">

    <img src="<?= BASE_URL ?>/public/galeria/i_6036673.jpg"
         alt="Záhrada v pozadí"
         class="banner-background-image">

    <div class="banner-full-image">
        <div class="banner-content">
            <h1>Vaša záhrada, naša vášeň.</h1>
            <p>Oživte svoj exteriér s našimi profesionálnymi službami a poradenstvom.</p>
        </div>
    </div>

    <h2>Prečo si vybrať Zelený Raj?</h2>
    <p>Sme rodinná firma s dlhoročnými skúsenosťami v oblasti záhradnej architektúry a starostlivosti o zeleň.</p>

    <?php if (!empty($featuredServices)): ?>
    <h3>Vybrané služby</h3>
    <div style="display:flex; gap:20px; flex-wrap:wrap; margin-bottom:24px;">
        <?php foreach ($featuredServices as $s): ?>
        <div style="flex:1; min-width:200px; background:#f9f9f4; border:1px solid #d4e8c2; border-radius:8px; padding:16px;">
            <strong><?= htmlspecialchars($s['name']) ?></strong>
            <p style="font-size:.9rem; color:#555; margin:6px 0;"><?= htmlspecialchars($s['description']) ?></p>
            <span style="color:#4a7c3f; font-weight:700;"><?= number_format((float)$s['price'], 2) ?> €</span>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <h3>Čo ponúkame:</h3>
    <ul>
        <li>Návrhy a realizácie záhrad</li>
        <li>Údržba trávnikov a stromov</li>
        <li>Predaj okrasných rastlín a drevín</li>
        <li>Automatické zavlažovacie systémy</li>
    </ul>

    <a href="index.php?page=services" class="styled-button">Prezrieť si kompletné služby</a>

</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
