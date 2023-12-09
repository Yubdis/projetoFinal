<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: paginaLogin.php");
require_once "functions.php";
// inserir item
insertCardapio($connect);
if (isset($_POST['update'])) {
	updateCardapio($connect);
}
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
		if (isset($_GET['id'])) {
			$idGet = $_GET['id'];
			$itemCardapio = buscaUnica($connect, "cardapio", $idGet);
			if (!empty($itemCardapio['titulo'])) {
				$id = $itemCardapio['id'];
				$titulo = $itemCardapio['titulo'];
				$descricao = $itemCardapio['descricao'];
				$data = $itemCardapio['data_registro'];
				$action = "update";
			}
		}
		?>

		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Inserir Item do Cardapio</legend>
				<input value="<?php echo $id; ?>" type="hidden" name="id" required>

				<?php if (!empty($itemCardapio['imagem'])) { ?>
					<img width="80px" src="imagens/uploads/<?php echo $itemCardapio['imagem']; ?>">
				<?php } ?>

				<div>
					<input type="file" name="imagem">
				</div>
				<div>
					<input value="<?php echo $titulo; ?>" type="text" name="titulo" placeholder="Titulo" required>
				</div>
				<div>
					<textarea name="descricao" required><?php echo $descricao; ?></textarea>
				</div>
				<div>
					<input value="<?php echo $data; ?>" type="date" name="data_registro" required>
				</div>
				<input type="submit" name="<?php echo $action; ?>" value="Salvar">
			</fieldset>
		</form>

	<?php } else {
		header("location: paginaLogin.php");
	} ?>
</body>

</html>