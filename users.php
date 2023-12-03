<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: paginaLogin.php");
require_once "functions.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Painel Admin - Usuarios</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<?php if ($seguranca) { ?>
		<div class="admin">

			<h1>Painel Adminstrativa do site</h1>
			<h2>Bem vindo <?php echo $_SESSION['nome']; ?> ao painel do site!</h2>
			<h3>Gerenciador de usuario</h3>

		</div>

		<nav>
			<div>
				<a href="index.php">Painel</a>
				<a href="users.php">Gerenciar Usuarios</a>
				<a href="deslogar.php">Sair</a>
			</div>
		</nav>

		<?php
		$tabela = "users";
		$order = "nome";
		$usuarios = buscar($connect, $tabela, 1, $order);
		?>


		<div>
			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>nome</th>
						<th>email</th>
						<th>data cadastro</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($usuarios as $usuario) : ?>
						<tr>
							<td><?php echo $usuario['id']; ?></td>
							<td><?php echo $usuario['nome']; ?></td>
							<td><?php echo $usuario['email']; ?></td>
							<td><?php echo $usuario['data_cadastro']; ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>