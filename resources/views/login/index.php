<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="<?= CSS; ?>styleLogin.css" >
</head>
<body>
  <div class="background">
    <div class="login-container">
      <img src="<?= IMG; ?>/logo_sigma.png" alt="Logo Sigma" class="logo">
      <form>
        <!-- Label and Input for NIM/NIP -->
        <label for="nim-nip" class="input-label" >NIM / NIP</label>
        <input type="text" id="nim-nip" class="input-field">
        
        <!-- Label and Input for Password -->
        <label for="password" class="input-label">Password</label>
        <input type="password" id="password" class="input-field">
        
        <!-- Submit Button -->
        <button type="submit" class="login-button">Masuk</button>
      </form>
    </div>
  </div>
</body>
</html>
