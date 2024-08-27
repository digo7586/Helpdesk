<?php
include 'init.php';
include('config/conn.php');

$chamadoId = $_GET['id'];
$chamadoQuery = $link->query("SELECT * FROM `hd_tickets` WHERE id = $chamadoId");
$chamado = mysqli_fetch_object($chamadoQuery);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Chamado | BAGCLEANER</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('inc/nav.php'); ?>
    <div class="container">
        <h1>Detalhes do Chamado</h1>
        <?php if ($chamado) { ?>
            <p><strong>ID:</strong> <?= $chamado->id ?></p>
            <p><strong>Problema:</strong> <?= $chamado->problem ?></p>
            <p><strong>Setor:</strong> <?= $chamado->department ?></p>
            <p><strong>Descrição:</strong> <?= $chamado->description ?></p>
            <p><strong>Status:</strong> <?= $chamado->status ?></p>
        <?php } else { ?>
            <p>Chamado não encontrado.</p>
        <?php } ?>
    </div>
</body>
</html>
