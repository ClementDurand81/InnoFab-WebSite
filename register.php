<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Innofab</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Register Section -->
  <section id="register" class="background d-flex align-items-center">
    <form class="container form-container" action="registerconfirm.php" method="post">
      <a href="login.php"><img src="assets\img\logo.png" class="logo-login" alt="Logo"></a>
      <div class="form-group">
        <label class="form-label" for="name">Nom</label>
        <input class="form-field" type="text" id="name" name="name" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="surname">Prénom</label>
        <input class="form-field" type="text" id="surname" name="surname" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input class="form-field" type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="phone">Téléphone</label>
        <input class="form-field" type="phone" id="phone" name="phone" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="password">Mot de passe</label>
        <input class="form-field" type="password" id="password" name="password" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="confirm-password">Confirmer mot de passe</label>
        <input class="form-field" type="password" id="confirm-password" name="confirm-password" required />
      </div>
      <button type="submit" class="btn-main">S'inscrire</button>
    </form>
  </section>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>