<?php require_once "admin/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Formulário de Contato</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>

	<header>
		<h1>Lesson Hub</h1>
		<p>Your destination for online lessons</p>
	</header>

	<section>
		<div class="container">
			<h2>Featured Lessons</h2>
			<div class="cardapio">
				<?php $cardapio = buscar($connect, "cardapio");
				foreach ($cardapio as $item) :  ?>
					<div class="bloco">
						<div class="imagem">
							<img width="100px" src="admin/imagens/uploads/<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>">
						</div>
						<div class="info-aula">
							<h3><?php echo $item['titulo']; ?></h3>
							<p><?php echo $item['descricao']; ?></p>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
		<p>Explore our curated collection of lessons to enhance your skills.</p>
	</section>

	<section>
		<h2>Popular Categories</h2>
		<!-- Add links to popular lesson categories -->
		<ul>
			<li><a href="#">Programming</a></li>
			<li><a href="#">Language Learning</a></li>
			<li><a href="#">Music</a></li>
			<li><a href="#">Science</a></li>
		</ul>
	</section>

	<footer>
		<p>&copy; 2023 Lesson Hub. All rights reserved.</p>
	</footer>

</body>

</html>