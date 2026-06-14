<?php require __DIR__ . '/../partials/header.php'; ?>

<section id="kontakt" class="section-padding">
    <h2>Vyžiadajte si nezáväznú cenovú ponuku</h2>

    <!-- FAQ Accordion -->
    <div class="accordion-container">
        <div class="accordion-item">
            <button class="accordion-header">Ako prebieha návrh záhrady?</button>
            <div class="accordion-content">
                <p>1. Konzultácia, 2. Návrh (2D/3D), 3. Cenová ponuka, 4. Realizácia.</p>
            </div>
        </div>
        <div class="accordion-item">
            <button class="accordion-header">Ktoré obdobie je najlepšie na výsadbu?</button>
            <div class="accordion-content">
                <p>Ideálna je jar (marec–máj) a jeseň (september–november).</p>
            </div>
        </div>
    </div>

    <?php if ($success): ?>
        <div class="flash flash-success">✅ Vaša správa bola úspešne odoslaná! Ozveme sa vám čo najskôr.</div>
    <?php endif; ?>

    <?php if (!$success): ?>
    <form id="contact-form" method="POST" action="index.php?page=contact" novalidate>

        <div class="form-group">
            <label for="name">Meno:</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
            <?php if (!empty($errors['email'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="message">Popis Vašej predstavy:</label>
            <textarea id="message" name="message" rows="5" required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
            <?php if (!empty($errors['message'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['message']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="privacy" name="privacy"
                   <?= isset($old['privacy']) ? 'checked' : '' ?> required>
            <label for="privacy">Súhlasím so spracovaním osobných údajov.*</label>
            <?php if (!empty($errors['privacy'])): ?>
                <div class="error-msg"><?= htmlspecialchars($errors['privacy']) ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="submit-button">Odoslať požiadavku</button>
    </form>
    <?php endif; ?>

    <p class="contact-links" style="margin-top:20px;">
        <a href="mailto:info@zelenyraj.sk">Email: info@zelenyraj.sk</a> |
        <a href="tel:+421900123456">Telefón: +421 900 123 456</a>
    </p>
</section>

<?php require __DIR__ . '/../partials/footer.php'; ?>
