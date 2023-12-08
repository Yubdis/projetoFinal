<?php

$servidor = "localhost";
$usuarioBd = "root";
$senhaBd = "";
$nomeBanco = "projetoFinal";

$conecta = mysqli_connect($servidor, $usuarioBd, $senhaBd, $nomeBanco);

if ($conecta) {
	echo "Conexão realizada com Sucesso!";
}
