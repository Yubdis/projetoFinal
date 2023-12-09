<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: paginaLogin.php");
require_once "functions.php";
// inserir item
insertCardapio($connect);
?>
<!DOCTYPE html>
<html>

<head>
	<title>Painel Admin - Cardapio</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<?php if ($seguranca) { ?>
		<div class="admin">

			<h1>Painel Adminstrativa do site</h1>
			<h2>Bem vindo <?php echo $_SESSION['nome']; ?> ao painel do site!</h2>
			<h3>Gerenciador do Cardapio</h3>

		</div>

		<?php include "<layout/menu.php"; ?>

		<?php
		$id = "";
		$titulo = "";
		$descricao = "";
		$data = date('Y-m-d');
		$action = "insert";

		?>
		<?php
		// if (isset($_GET['id'])) {
		// $id = $_GET['id'];
		// $usuario = buscaUnica($connect, "users", $id);
		// updateUser($connect);
		?>

		<?php //}
		?>

		<form action="" method="post">
			<fieldset>
				<legend>Inserir Item do Cardapio</legend>
				<input value="<?php echo $id; ?>" type="hidden" name="id" required>
				<div>
					<input type="file" name="imagem">
				</div>
				<div>
					<input value="<?php echo $titulo; ?>" type="text" name="titulo" placeholder="Titulo" required>
				</div>
				<div>
					<textarea name="descricao" required></textarea>
				</div>
				<div>
					<input value="<?php echo $data_registro; ?>" type="date" name="data_registro" required>
				</div>
				<input type="submit" name="<?php echo $action; ?>" value="Salvar">
			</fieldset>
		</form>

	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>