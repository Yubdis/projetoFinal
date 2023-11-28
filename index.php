<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Bem vindo ao painel administrativo</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<?php if (isset($_SESSION['ativa'])) { ?>
		<div class="admin">
			<p>
				<a href="admin.php">Início</a> -
				<a href="usuarios.php">Usuários</a>
			</p>
			<h1>
				Bem vindo <?php echo $_SESSION['nome']; ?> ao painel do site!
			</h1>
			<p>
				Aqui você tem acesso a administração do seu sistema...
			</p>

			<a class="sair" href="deslogar.php"> Sair </a>

		</div>
	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>