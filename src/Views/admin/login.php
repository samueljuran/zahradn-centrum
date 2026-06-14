<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Prihlásenie | Zelený Raj</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body   { font-family: 'Segoe UI', sans-serif; background: #2d5a27; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .login-box { background: #fff; border-radius: 14px; padding: 40px 36px; width: 100%; max-width: 380px; box-shadow: 0 8px 32px rgba(0,0,0,.25); }
        .login-box h1 { text-align: center; color: #2d5a27; font-size: 1.5rem; margin-bottom: 8px; }
        .login-box p  { text-align: center; color: #777; font-size: .88rem; margin-bottom: 28px; }
        .form-group   { margin-bottom: 18px; }
        label { display: block; font-weight: 600; font-size: .85rem; margin-bottom: 6px; color: #444; }
        input { width: 100%; padding: 10px 14px; border: 1px solid #ccc; border-radius: 8px; font-size: .95rem; }
        input:focus { outline: none; border-color: #4a7c3f; box-shadow: 0 0 0 3px rgba(74,124,63,.15); }
        .btn-submit { width: 100%; padding: 12px; background: #2d5a27; color: #fff; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; margin-top: 8px; }
        .btn-submit:hover { background: #3d7a35; }
        .error  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 6px; padding: 10px 14px; margin-bottom: 18px; font-size: .88rem; }
        .back   { display: block; text-align: center; margin-top: 20px; color: #888; font-size: .85rem; text-decoration: none; }
        .back:hover { color: #2d5a27; }
    </style>
</head>
<body>
<div class="login-box">
    <h1>🌿 Zelený Raj</h1>
    <p>Prihlásenie do administrácie</p>

    <?php if (!empty($error)): ?>
        <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=admin-login">
        <div class="form-group">
            <label for="username">Používateľské meno</label>
            <input type="text" id="username" name="username" required autofocus
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="password">Heslo</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-submit">Prihlásiť sa</button>
    </form>

    <a href="index.php" class="back">← Späť na web</a>
</div>
</body>
</html>
