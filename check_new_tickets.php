<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}

require_once('config/conn.php');
// Consultar o banco de dados para verificar se há novos tickets não resolvidos
$query = "SELECT COUNT(*) AS total FROM `hd_tickets` WHERE resolved = 0";
$result = $link->query($query);

// Verificar se a consulta foi bem-sucedida
if ($result) {
    // Obter o número total de tickets não resolvidos
    $row = $result->fetch_assoc();
    $totalTickets = $row['total'];

    // Verificar se há novos tickets
    $newTickets = ($totalTickets > 0) ? true : false;

    // Retornar a resposta como JSON
    echo json_encode(array("newTickets" => $newTickets));
} else {
    // Se houver um erro na consulta, retornar um JSON com um indicador de erro
    echo json_encode(array("error" => "Erro ao consultar o banco de dados."));
}
?>
