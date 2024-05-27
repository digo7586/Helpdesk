<?php 
// Seu código PHP existente...

// Obtenha os dados dos chamados por setor
$dadosChamadosPorSetor = [];
while ($ocorrenciaPorSetor = mysqli_fetch_object($totalSetor)) {
    $setorNome = $link->query("SELECT * FROM `hd_departments` WHERE id = $ocorrenciaPorSetor->department");
    $setor = mysqli_fetch_object($setorNome);
    $dadosChamadosPorSetor[$setor->name] = $ocorrenciaPorSetor->qtd;
}

// Transforme os dados em um formato que o JavaScript possa usar
$labelsChamadosPorSetor = array_keys($dadosChamadosPorSetor);
$valoresChamadosPorSetor = array_values($dadosChamadosPorSetor);
?>

<!-- Seu HTML existente... -->

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?= json_encode($labelsChamadosPorSetor) ?>,
      datasets: [{
        label: 'Chamados',
        data: <?= json_encode($valoresChamadosPorSetor) ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- Seu HTML existente... -->
