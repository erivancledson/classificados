<?php
require 'config.php';
if(empty($_SESSION['cLogin'])) {
	header("Location: login.php");
	exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();


//verifica se aconteceu o envio do id ele chama excluirAnuncio
if(isset($_GET['id']) && !empty($_GET['id'])) {
	$a->excluirAnuncio($_GET['id']);
}

header("Location: meus-anuncios.php");