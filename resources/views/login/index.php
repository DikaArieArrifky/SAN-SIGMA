<!DOCTYPE html>
<html lang="en">

<head>
  <link href="<?= IMG; ?>/logo_sigma.png" rel="icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="<?= CSS; ?>styleLogin.css">
</head>

<body>
  <div class="background">
    <div class="login-container">
      <img src="<?= IMG; ?>/logo_sigma.png" alt="Logo Sigma" class="logo">
      <form method="post" action="postLogin">
        <!-- Error Message -->
        <div class="alert alert-danger" style="display: <?= isset($data['not_found']) ? 'flex' : 'none' ?>; 
            padding: 10px;
            border-radius: 4px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            margin-bottom: 15px;
            align-items: center;
            justify-content: center;
            position: relative;">
          <span>Username atau Password salah!</span>
          <span onclick="this.parentElement.style.display='none'"
            style="position: absolute;
             right: 10px;
             margin-right: 5px;
             cursor: pointer;
             font-weight: bold;">
            X
          </span>
        </div>
        <label for="nim-nip" class="input-label">Username</label>
        <input type="text" id="nim-nip" class="input-field" placeholder="Username" name="username" value="<?= isset($data['username']) ? htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8') : '' ?>">

        <!-- Label and Input for Password -->
        <label for="password" class="input-label">Password</label>
        <input type="password" id="password" class="input-field" placeholder="Password" name="password" value="<?= isset($data['password']) ? htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8') : '' ?>">
        <!-- Submit Button -->
        <button type="submit" class="login-button">Masuk</button>
      </form>
    </div>
  </div>
</body>

</html>