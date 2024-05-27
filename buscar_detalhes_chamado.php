<?php
require_once('config/conn.php');

if (isset($_GET['id'])) {
    $chamadoId = $_GET['id'];
    $query = $link->query("SELECT * FROM `hd_tickets` WHERE id = $chamadoId");
    $chamado = mysqli_fetch_object($query);

    if ($chamado) {
        echo "<p>ID: {$chamado->id}</p>";
        echo "<p>Descrição: {$chamado->description}</p>";
        echo "<p>Status: " . ($chamado->resolved ? 'Concluído' : 'Em andamento') . "</p>";
        // Adicione outras informações que desejar exibir
    } else {
        echo "<p>Chamado não encontrado.</p>";
    }
} else {
    echo "<p>ID do chamado não fornecido.</p>";
}
?>
