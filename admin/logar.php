<?php
require_once "functions.php";


if (isset($_POST['acessar']) and !empty($_POST['email']) and !empty($_POST['senha'])) {

	$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	// if (array_key_exists($email, $usuarios)) {
	// 	if ($senha == $usuarios[$email]) {
	// 		session_start();
	// 		$_SESSION['email'] = $email;
	// 		$_SESSION['ativa'] = true;
	// 		header("location: admin.php");
	// 	} else {
	// 		echo "Senha incorreta!";
	// 	}
	// } else {
	// 	echo "E-mail incorreto!";
	// }
	//Verificação de login e senha únicos
	if ($email ==  $emailAcesso and $senha == $senhaAcesso) {
		//Inicia / cria uma sessão
		session_start();
		//Variaveis de sessão
		$_SESSION['email'] = $email;
		$_SESSION['ativa'] = true;
		header("location: index.php");
	} else {
		echo "E-mail ou senha incorretos!<br>";
		echo "<a href='index.php'> Voltar </a>";
	}
} else {
	echo "Dados Inválidos!";
}

//echo "<a href='admin.php'> Login realizado com sucesso, acesse o painel clicando aqui </a>";