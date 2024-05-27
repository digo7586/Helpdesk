<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
require_once('inc/header.php');
$user = $users->getUserInfo();

require_once('config/conn.php');
require_once 'class/Users.php';

// Verificar se o usuário está logado
$userObj = new Users();
if(!$userObj->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

// Obter o ID do usuário logado
$userID = $_SESSION['userid'];



?>
<title>SUPORTE | BAGCLEANER</title>
<script src="js/jquery.dataTables.min.js"></script>


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

	

		<?php include_once('dashUser.php'); ?>


	
	<div class="panel-heading">
		<div class="row-reverse">
			
			<div class="chat">
				<div class="btnTicket">
					<button type="button" name="add" id="createTicket" class="btn btn-success btn-md">Abrir Ticket</button>
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

	
	<table id="listTicketsFim" class="table table-striped table table-hover table-sm mt-2">
		<thead>
			<tr>
				<th scope="col">N°</th>
				<!-- <th scope="col">Ticket ID</th> -->
				<th scope="col">Ocorrência</th>
				<th scope="col">Descrição</th>
				<th scope="col">Departmento</th>
				<th scope="col">Usúario</th>
				<th scope="col">Criado</th>
				<th scope="col">Status</th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</thead>

		<tbody>
        <?php
        // Modifique sua consulta para juntar as tabelas 'hd_tickets', 'hd_departments' e 'hd_users'
        $ticketsQuery = $link->query("SELECT t.id, t.uniqid, p.name as problem, t.title, d.name as department_name, u.name as user_name, t.date, t.resolved 
        FROM `hd_tickets` t 
        LEFT JOIN `hd_departments` d ON t.department = d.id 
        LEFT JOIN `hd_users` u ON t.user = u.id
        LEFT JOIN `problemas` p ON t.problem = p.id
        WHERE user = $userID AND resolved = '1'");
    
			

        while ($ticket = mysqli_fetch_assoc($ticketsQuery)) {
        ?>
            <tr>
                <td><?php echo $ticket['id']; ?></td>
             <!--    <td><?php echo $ticket['uniqid']; ?></td> -->
                <td><?php echo $ticket['problem']; ?></td>
                <td><?php echo $ticket['title']; ?></td>
                <td><?php echo $ticket['department_name']; ?></td>
                <td><?php echo $ticket['user_name']; ?></td>
                <td><?php echo $time->tempo($ticket['date']); ?></td>
                <td><?php echo ($ticket['resolved'] == 2) ? "Resolvido" : "Aberto"; ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
	
	<?php require_once('inc/footer.php'); ?>
</div>

<script src="js/notification.js"></script>