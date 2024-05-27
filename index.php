<?php 
include 'init.php'; 
if(!$users->isLoggedIn()) {
	header("Location: login.php");	
} else {
	header("Location: ticket.php");	
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<title>Suporte | ENGEBAG E BAGCLEANER</title>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<!-- <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> -->
<script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script>

<script src="js/general.js"></script>

<script src="js/tickets.js"></script>

<link rel="stylesheet" href="css/style.css" />


<?php include('inc/nav.php'); ?>
<?php include('inc/container.php');?>
<div class="container">	
	 
	<div class="">   		
		<p>Visualize e gerêncie tickets</p>	

		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="createTicket" class="btn btn-success btn-xs">Tickets</button>
				</div>
			</div>
		</div>
		<table id="listTickets" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>S/N66</th>
					<!-- <th>Ticket ID</th> -->
					<th>Subject</th>
					<th>Department</th>
					<th>Created By</th>					
					<th>Created</th>	
					<th>Status</th>
					<th></th>
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	<?php include('add_ticket_model.php'); ?>
</div>	
<?php include('inc/footer.php');?>

<script>
    // Função para fazer a solicitação AJAX
function checkForNewTickets() {
    // Fazer a solicitação AJAX para o arquivo PHP que executa a consulta SQL
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'check_new_tickets.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Verificar se há novos tickets
            var response = JSON.parse(xhr.responseText);
            if (response.newTickets) {
                alert("Novos tickets foram encontrados!");
            }
        }
    };

    xhr.send();
}

// Chamar a função checkForNewTickets a cada 5 minutos
setInterval(checkForNewTickets, 3 * 1000);
</script>