<?php require_once "functions.php";
if (isset($_POST['acessar'])) {
  login($connect);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Pagina De Login</title>
  <link rel="stylesheet" href="css/paginaLogin.css" />
</head>

<body>
  <div class="login-box">
    <h2>login</h2>
    <form method="post" action="">
      <div class="user-box">
        <input type="email" name="email" placeholder="Email" required>
        <label></label>
      </div>
      <div class="user-box">
        <input type="password" name="senha" placeholder="Password" required>
        <label></label>
      </div>
      <a href="">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        submit
      </a>
      <input type="submit" name="acessar" value="Acessar"></input>
    </form>

  </div>
</body>

</html>