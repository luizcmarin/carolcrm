<!-- app/Views/install/already_installed.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Installation Complete</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>

<body class="container mt-5">
  <div class="alert alert-info">
    <h4>Installation already finished!</h4>
    <p>The system is already installed. If you need to re-install, please remove <code>app/Config/app-config.php</code> and delete all database tables first.</p>
    <p><a href="<?= base_url(); ?>" class="btn btn-primary">Go to Application</a></p>
  </div>
</body>

</html>