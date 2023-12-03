<?php session_start(); ?>
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: paginaLogin.php");
<!DOCTYPE html>
<html>

<head>
	<title>Painel Admin</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<?php if ($seguranca) { ?>
		<div class="admin">

			<h1>Painel Adminstrativa do site</h1>
			<h2>Bem vindo <?php echo $_SESSION['nome']; ?> ao painel do site!</h2>
			<p>Aqui você tem acesso a administração do seu sistema...</p>

		</div>
		<nav>
			<div>
				<a href="index.php">Painel</a>
				<a href="users.php">Gerenciar Usuarios</a>
				<a href="deslogar.php">Sair</a>
			</div>
		</nav>
	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>