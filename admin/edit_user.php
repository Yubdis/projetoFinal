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

		<?php include "<layout/menu.php"; ?>

		<?php
		$tabela = "users";
		$order = "nome";
		$usuarios = buscar($connect, $tabela, 1, $order);

		// deletar($connect, $tabela, $id);
		?>
		<?php if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$usuario = buscaUnica($connect, "users", $id);
			updateUser($connect);
		?>
			<h2>Editando o usuario <?php echo $_GET['nome']; ?></h2>

		<?php } ?>

		<form action="" method="post">
			<fieldset>
				<legend>Editar Usuarios</legend>
				<input value="<?php echo $usuario['id']; ?>" type="hidden" name="id" required>
				<input value="<?php echo $usuario['nome']; ?>" type="text" name="nome" placeholder="Nome" required>
				<input value="<?php echo $usuario['email']; ?>" type="email" name="email" placeholder="Email" required>
				<input type="password" name="senha" placeholder="Senha">
				<input type="password" name="repetesenha" placeholder="Confirme sua Senha">
				<input value="<?php echo $usuario['data_cadastro']; ?>" type="date" name="data_cadastro">
				<input type="submit" name="atualizar" value="Cadastrar" required>
			</fieldset>
		</form>

	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>