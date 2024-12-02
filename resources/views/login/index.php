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
        <!-- Label and Input for NIM/NIP -->
        <label for="nim-nip" class="input-label">Username</label>
        <input type="text" id="nim-nip" class="input-field" placeholder="Username"  name="username" value="<?= isset($data['username']) ? $data['username'] : '' ?>" >

        <!-- Label and Input for Password -->
        <label for="password" class="input-label">Password</label>
        <input type="password" id="password" class="input-field" placeholder="Password"  name="password" value="<?= isset($data['password']) ? $data['password'] : '' ?>">
        <!-- Submit Button -->
        <button type="submit" class="login-button">Masuk</button>
      </form>
    </div>
  </div>
</body>

</html>