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
