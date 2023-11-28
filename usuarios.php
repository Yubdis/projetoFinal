<?php session_start(); 
	require_once "dados.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bem vindo ao painel administrativo</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<?php if ( isset($_SESSION['ativa']) ) { ?>
	<div class="admin">
		<p>
			<a href="admin.php">Início</a> - 
			<a href="usuarios.php">Usuários</a>
		</p>
		<h1>
			Gerenciador de Usuários
		</h1>
		<ul>
			<?php 
				$emails = array_keys($usuarios);
				foreach ($emails as $email) {
					echo "<li>$email</li>";
				}
			 ?>
		</ul>

		<a class="sair" href="deslogar.php"> Sair </a>

	</div>
<?php } else {
	echo "<p>Você não tem acesso a essa página!</p>";
} ?>
</body>
</html>