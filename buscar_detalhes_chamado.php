<?php
require_once('config/conn.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $link->query("SELECT * FROM `hd_tickets` WHERE id = $id");
    
    // Adicionando logs para depuração
    if ($query) {
        if ($chamado = mysqli_fetch_object($query)) {
            // Formate os detalhes do chamado conforme necessário
            echo "<p><strong>ID:</strong> {$chamado->id}</p>";
            echo "<p><strong>Título:</strong> {$chamado->title}</p>";
            echo "<p><strong>Descrição:</strong> {$chamado->description}</p>";
            echo "<p><strong>Status:</strong> " . ($chamado->resolved ? 'Concluído' : 'Em andamento') . "</p>";
            // Adicione outros campos conforme necessário
        } else {
            echo "<p>Detalhes do chamado não encontrados.</p>";
        }
    } else {
        echo "<p>Erro na consulta: " . mysqli_error($link) . "</p>";
    }
} else {
    echo "<p>ID do chamado não fornecido.</p>";
}
?>
