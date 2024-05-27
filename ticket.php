<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
require_once('inc/header.php');
$user = $users->getUserInfo();

require_once('config/conn.php');

########################### total de usuarios #########################################
$totalUsuarios = $link->query("SELECT COUNT(id) as qtd FROM `hd_users` where status = 1");

while ($usuariosCadastrados = mysqli_fetch_object($totalUsuarios)) {
	$usuarios = $usuariosCadastrados->qtd;
}

########################## Total de chamados ########################################
$totalChamados = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets`");

while ($chamadosCadastrados = mysqli_fetch_object($totalChamados)) {
	$chamadosAbertos = $chamadosCadastrados->qtd;
}

########################## Total de chamados em andamento ########################################
$totalLidos = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE admin_read = 1");

while ($chamadosLidos = mysqli_fetch_object($totalLidos)) {
	$chamadosEmAndamento = $chamadosLidos->qtd;
}

############################## TOTAL DE CHAMADOS CONCLUIDOS ####################################
$totalConcluido = $link->query("SELECT COUNT(id) as qtd FROM `hd_tickets` WHERE resolved = 1");

while ($chamadosfinalizados = mysqli_fetch_object($totalConcluido)) {
	$chamadosFim = $chamadosfinalizados->qtd;
}

?>
<title>SUPORTE | BAGCLEANER</title>
<script src="js/jquery.dataTables.min.js"></script>

<!-- <script src="js/dataTables.bootstrap.min.js"></script>	 -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script>

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

	<?php if (isset($_SESSION['admin'])) { ?>

		<?php include_once('infodash.php'); ?>


	<?php } ?>
	<div class="panel-heading">
		<div class="row-reverse">
			<div class="col-md-1">
				<h3 class="panel-title"></h3>
			</div>
			<div class="chat">
				<div class="btnTicket">
					<button type="button" name="add" id="createTicket" class="btn btn-success btn-md">Abrir Ticket</button>
				</div>
				<div>
					<a href="./chatw/users.php" target="_blank">
						<button type="button" class="btn btn-chat ms-5">
							<i class="bi bi-chat-dots icoChat"></i> <span>Bag Chat</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<table id="listTickets" class="table table-striped table table-hover table-sm">
		<thead>
			<tr>
				<th>N°</th>
				<th>Ticket ID</th>
				<th>Descrição</th>
				<th>Departmento</th>
				<th>Usúario</th>
				<th>Criado</th>
				<th>Status</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
	</table>

	<?php require_once('inc/footer.php'); ?>
</div>