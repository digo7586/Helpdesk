<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
require_once('inc/header.php');
$user = $users->getUserInfo();

require_once('config/conn.php');

########################## Total de chamados ########################################
// consulta para obter total de chamados cadastrados
$totalChamadosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");
$totalchamadosResult = mysqli_fetch_object($totalChamadosQuery);
$chamadosAbertos = $totalchamadosResult->qtd;

// Verifica se há chamados abertos antes de calcular a porcentagem de andamento e concluídos
    if ($chamadosAbertos > 0 ) {
        // Consulta para obter o total de chamados em andamento
        $totalEmAnadamentoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1 AND resolved = 0");
        $totalEmAnadamentoResult = mysqli_fetch_object($totalEmAnadamentoQuery);
        $chamadosEmAndamento = $totalEmAnadamentoResult->qtd;

         // Consulta para obter o total de chamados concluídos
         $totalConcluidoQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");
         $totalConcluidoResult = mysqli_fetch_object($totalConcluidoQuery);
         $chamadosFim = $totalConcluidoResult->qtd;

         // Calcula a porcentagem de chamados em andamento e concluídos
         $progressoEmAndamento = ($chamadosEmAndamento / $chamadosAbertos) * 100;
         $progressoConcluido = ($chamadosFim / $chamadosAbertos) * 100;
    } else {
         // Define como zero se não houver chamados abertos
         $progressoEmAndamento = 0;
         $progressoConcluido = 0;
    }


// Consulta para obter o total de usuários cadastrados com status ativo
$totalUsuariosQuery = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` WHERE status = 1");
$totalUsuariosResult = mysqli_fetch_object($totalUsuariosQuery);
$usuarios = $totalUsuariosResult->qtd;



?>
<title>SUPORTE | BAGCLEANER</title>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="shortcut icon" href="icone.ico">

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  

 <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> 
<!-- <script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 

<script src="js/general.js"></script>
<script src="js/department.js"></script>

<script src="js/tickets.js"></script>
<script src="js/showPassword.js"></script>

<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/styleHome.css" />

<?php require_once('inc/nav.php'); ?>
<?php require_once('inc/container.php'); ?>
<?php include('add_ticket_model.php'); ?>

<div class="container-fluid">
	
<?php 
	if (isset($_SESSION['admin'])) { 
		include_once('infodash.php');
	} else {
		include_once('dashUser.php');
	}
?>



	<div class="panel-heading">
		<div class="row-reverse">
			
			<div class="chat">
				<div class="btnTicket">
					<button type="button" name="add" id="createTicket" class="btn btn-success btn-md">Abrir Chamado</button>
				</div>
				<!-- <div>
					<a href="./chatw/users.php">
						<button type="button" class="btn btn-chat ms-5">
							<i class="bi bi-chat-dots icoChat"></i> <span>Bag Chat</span>
						</button>
					</a>
				</div> -->
			</div>
		</div>
	</div>

	
	<table id="listTickets" class="table table-striped table table-hover table-sm mt-2">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col"></th>
				<th scope="col">Ocorrêcia</th>
				<th scope="col">Descrição</th>
				<th scope="col">Setor</th>
				<th scope="col">Usuário</th>
				<th scope="col">Aberto</th>
				<th scope="col">Status</th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				
			</tr>
		</thead>
	</table>
	
	<?php require_once('inc/footer.php'); ?>
</div>

