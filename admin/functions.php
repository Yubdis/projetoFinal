<?php
$server = "localhost";
$userDb = "root";
$passDb = "";
$database = "projetofinal";
$connect = mysqli_connect($server, $userDb, $passDb, $database);

//funcao para login
function login($connect)
{

	if (isset($_POST['acessar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$senha = sha1($_POST['senha']);
		$query = "SELECT * FROM users WHERE email = '$email' AND senha	= '$senha' ";
		$executar = mysqli_query($connect, $query);
		$return = mysqli_fetch_assoc($executar);

		if (!empty($return['email'])) {
			session_start();
			$_SESSION['nome'] = $return['nome'];
			$_SESSION['id'] = $return['id'];
			$_SESSION['ativa'] = TRUE;
			header("location: index.php");
			exit;
		} else {
			echo "Usuario ou senha nao encontrado!";
		}
	}
}
// funcao logout
function logout()
{
	session_start();
	//Limpar os caches da sessão
	session_unset();
	//Encerra / fecha a sessão
	session_destroy();
	header("location: paginaLogin.php");
}

// Seleciona(busca) no BD apenas um resultado com base no ID
function buscaUnica($connect, $tabela, $id)
{
	$query = "SELECT * FROM $tabela WHERE id =" .  (int)$id;
	$executar = mysqli_query($connect, $query);
	$result = mysqli_fetch_assoc($executar);
	return $result;
}
// Seleciona(busca) no BD apenas um resultado com base no WHERE
function buscar($connect, $tabela, $where = 1, $order = "")
{
	if (!empty($order)) {
		$order = "ORDER BY $order";
	}
	$query = "SELECT * FROM $tabela WHERE $where $order";
	$executar = mysqli_query($connect, $query);
	$results = mysqli_fetch_all($executar, MYSQLI_ASSOC);
	return $results;
}
//função para inserir usuários
function insertUser($connect)
{
	if (isset($_POST['cadastrar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {
		$erros = array();
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$senha = sha1($_POST['senha']);

		if ($_POST['senha'] != $_POST['repetesenha']) {
			$erros[] = "Senhas nao conferem!";
		}
		$queryEmail = "SELECT email FROM users WHERE email = '$email' ";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail);

		if (!empty($verifica)) {
			$erros[] = "E-mail ja cadastrado";
		}
		if (empty($erros)) {
			// inserir usuario no BD
			$query = "INSERT INTO users (nome, email, senha, data_cadastro) VALUES ( '$nome', '$email', '$senha', NOW() ) ";
			$executar = mysqli_query($connect, $query);
			if ($executar) {
				echo "Usuario Inserido com Sucesso!";
			} else {
				echo "Erro ao inserir Usuario!";
			}
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}

// Deletar algum dado
function deletar($connect, $tabela, $id)
{
	if (!empty($id)) {
		$query = "DELETE FROM $tabela WHERE id =" . (int) $id;
		$executar = mysqli_query($connect, $query);
		if ($executar) {
			echo "Dado Deletado com Sucesso!";
		} else {
			echo "Erro ao deletar!";
		}
	}
}

function updateUser($connect)
{
	if (isset($_POST['atualizar']) and !empty($_POST['email'])) {
		$erros = array();
		$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$senha = "";
		$data = mysqli_real_escape_string($connect, $_POST['data_cadastro']);

		if (empty($data)) {
			$erros[] = "Preencha a data de cadastro";
		}
		if (empty($email)) {
			$erros[] = "Preencha seu e-mail corretament";
		}
		if (strlen($nome) < 4) {
			$erros[] = "Preencha seu completo";
		}
		if (!empty($_POST['senha'])) {
			if ($_POST['senha'] == $_POST['repetesenha']) {
				$senha = sha1($_POST['senha']);
			} else {
				$erros[] = "Senhas nao conferem!";
			}
		}
		if ($_POST['senha'] != $_POST['repetesenha']) {
			$erros[] = "Senhas nao conferem!";
		}
		$queryEmailAtual = "SELECT email FROM users WHERE id = $id";
		$buscaEmailAtual = mysqli_query($connect, $queryEmailAtual);
		$returnEmail = mysqli_fetch_assoc($buscaEmailAtual);
		$queryEmail = "SELECT email FROM users WHERE email = '$email' AND email <> '" . $returnEmail['email'] . "'";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail);

		if (!empty($verifica)) {
			$erros[] = "E-mail ja cadastrado";
		}
		if (empty($erros)) {
			// UPDATE usuario
			if (!empty($senha)) {
				$query = "UPDATE users SET nome = '$nome', email = '$email', senha = '$senha', data_cadastro = '$data'
					WHERE id = " . (int)$id;
			} else {
				$query = "UPDATE users SET nome = '$nome', email = '$email', data_cadastro = '$data'
					WHERE id = " . (int)$id;
			}
			$executar = mysqli_query($connect, $query);
			if ($executar) {
				echo "Usuario Atualizar com Sucesso!";
			} else {
				echo "Erro ao atualizar usuario!";
			}
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}
function insertCardapio($connect)
{
	if (isset($_POST['insert']) and !empty($_POST['titulo']) and !empty($_POST['descricao'])) {

		$titulo = mysqli_real_escape_string($connect, $_POST['titulo']);
		$descricao = mysqli_real_escape_string($connect, $_POST['descricao']);
		$data = mysqli_real_escape_string($connect, $_POST['data_registro']);
		$imagem = !empty($_FILES['imagem']['name']) ? $_FILES['imagem']['name'] : "";
		$retornoUpload = "";
		if (!empty($imagem)) {
			$caminho = "imagens/uploads/";
			$retornoUpload = uploadImage($caminho);
			if (is_array($retornoUpload)) {
				foreach ($retornoUpload as $erro) {
					echo $erro;
				}
				$imagem = "";
			} else {
				$imagem = $retornoUpload;
			}
		}

		$query = "INSERT INTO cardapio (titulo, descricao, imagem, data_registro)
			VALUES ( '$titulo', '$descricao', '$imagem', '$data' ) ";
		$executar = mysqli_query($connect, $query);
		if ($executar) {
			if (is_array($retornoUpload)) {
				echo "Item indersido com sucesso! Porem a imagem nao pode ser inserida!";
			} else {
				header("location: cardapio.php");
			}
		} else {
			echo "Erro ao inserir Usuario!";
		}
	}
}
function updateCardapio($connect)
{
	if (isset($_POST['update']) and !empty($_POST['titulo']) and !empty($_POST['descricao'])) {
		$id = (int)$_POST['id'];
		$titulo = mysqli_real_escape_string($connect, $_POST['titulo']);
		$descricao = mysqli_real_escape_string($connect, $_POST['descricao']);
		$data = mysqli_real_escape_string($connect, $_POST['data_registro']);

		$imagem = !empty($_FILES['imagem']['name']) ? $_FILES['imagem']['name'] : "";
		$retornoUpload = "";
		if (!empty($imagem)) {
			$caminho = "imagens/uploads/";
			$retornoUpload = uploadImage($caminho);
			if (is_array($retornoUpload)) {
				foreach ($retornoUpload as $erro) {
					echo $erro;
				}
				$imagem = "";
			} else {
				$imagem = $retornoUpload;
			}
		}
		if (!empty($id)) {
			if (!empty($imagem)) {
				$query = "UPDATE cardapio SET imagem = '$imagem', titulo = '$titulo', descricao = '$descricao',
				data_registro = '$data' WHERE id = $id";
			} else {
				$query = "UPDATE cardapio SET titulo = '$titulo', descricao = '$descricao',
					data_registro = '$data' WHERE id = $id";
			}


			$executar = mysqli_query($connect, $query);
			if ($executar) {
				if (is_array($retornoUpload)) {
					echo "Item atualizado com sucesso! Porem a imagem nao pode ser inserida!";
				} else {
					header("location: cardapio.php");
				}
			} else {
				echo "Erro ao inserir Usuario!";
			}
		}
	}
}
function uploadImage($caminho)
{
	if (!empty($_FILES['imagem']['name'])) {

		$nomeImagem = $_FILES['imagem']['name'];
		$tipo = $_FILES['imagem']['type'];
		$nomeTemporario = $_FILES['imagem']['tmp_name'];
		$tamanho = $_FILES['imagem']['size'];
		$erros = array();

		$tamanhoMaximo = 1024 * 1024 * 5; //5MB
		if ($tamanho > $tamanhoMaximo) {
			$erros[] = "Seu arquivo excede o tamanho máximo<br>";
		}

		$arquivosPermitidos = ["png", "jpg", "jpeg"];
		$extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
		if (!in_array($extensao, $arquivosPermitidos)) {
			$erros[] = "Arquivo não permitido.<br>";
		}

		$typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
		if (!in_array($tipo, $typesPermitidos)) {
			$erros[] = "Tipo de arquivo não permitido.<br>";
		}

		if (!empty($erros)) {
			// foreach ($erros as $erro) {
			// 	echo $erro;
			// }
			return $erros;
		} else {

			$hoje = date("d-m-Y_h-i");
			$novoNome = $hoje . "-" . $nomeImagem;
			if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
				return $novoNome;
			} else {
				return FALSE;
			}
		}
	}
}
