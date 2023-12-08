<?php session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: paginaLogin.php");
require_once "functions.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<title>Painel Admin - Cardapio</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
	<?php if ($seguranca) { ?>
		<div>

			<h1>Painel administrativo do site</h1>
			<h2>Bem vindo <?php echo $_SESSION['nome']; ?> ao painel do site!</h2>
			<h3>Gerenciador de Cardapio</h3>

		</div>

		<?php include "<layout/menu.php"; ?>
	<?php } ?>
	<?php
	$tabela = "cardapio";
	$order = "titulo";
	$cardapios = buscar($connect, $tabela, 1, $order);

	if (isset($_GET['id'])) { ?>
		<h2>Ter certeza que deseja deletar do cardapio o item: <?php echo $_GET['titulo']; ?></h2>
		<form action="cardapio.php" method="post">
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			<input type="submit" name="deletar" value="Deletar">
		</form>
	<?php }
	if (isset($_POST['deletar']) and !empty($_POST['id'])) {
		deletar($connect, "cardapio", $_POST['id']);
	}
	?>

	<div>
		<table border="1">
			<thead>
				<tr>
					<th>Imagem</th>
					<th>Titulo</th>
					<th>Data Cadastro</th>
					<th>Acoes</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cardapios as $cardapio) : ?>
					<tr>
						<td><?php echo $cardapio['imagem']; ?></td>
						<td><?php echo $cardapio['titulo']; ?></td>
						<td><?php echo $cardapio['data_registro']; ?></td>
						<td>
							<a href="cardapio.php?id=<?php echo $cardapio['id']; ?>&titulo=<?php echo $cardapio['titulo']; ?>">Excluir</a>
							<a href="edit_user.php?id=<?php echo $cardapio['id']; ?>&titulo=<?php echo $cardapio['titulo']; ?>">Editar</a>

						</td>
					</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>

</html>