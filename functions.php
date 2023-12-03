<?php
$server = "localhost";
$userDb = "root";
$passDb = "";
$database = "projetoFinal";
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
			echo "Bem vindo " . $return['nome'];
			session_start();
			$_SESSION['nome'] = $return['nome'];
			$_SESSION['id'] = $return['id'];
			$_SESSION['ativa'] = TRUE;
			header("location: index.php");
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

//função para inserir usuários
function insertUser($connect)
{
	if (isset($_POST['submit'])) {
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
		$senha = mysqli_real_escape_string($connect, $_POST['senha']);
		$mensagem = mysqli_real_escape_string($connect, $_POST['mensagem']);

		if (!empty($nome) and !empty($email) and !empty($senha)) {
			$senha = sha1($senha);
			$query = "INSERT INTO users (nome, email, senha, mensagem, data_cadastro) VALUES ( '$nome', '$email', '$senha', '$mensagem', NOW() ) ";
			$execute = mysqli_query($connect, $query);
			if ($execute) {
				echo "Usuário inserido com sucesso!";
			} else {
				echo "Erro ao inserir dado!";
			}
		} else {
			echo "Preencha todos os dados corretamente!";
		}
	}
}

function selectDados($connect, $tabela, $where = "1")
{
	$query = "SELECT * FROM $tabela WHERE $where ";
	$execute = mysqli_query($connect, $query);
	//Trás os dados do SELECT do banco
	//MYSQLI_NUM - MYSQLI_BOTH - MYSQLI_ASSOC
	$result = mysqli_fetch_all($execute, MYSQLI_ASSOC);
	return $result;
}
