<?php
class Tickets extends Database {  
    private $ticketTable = 'hd_tickets';
	private $ticketRepliesTable = 'hd_ticket_replies';
	private $departmentsTable = 'hd_departments';
	private $priorityTable = 'problemas';
	private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    } 
	public function showTickets(){
		$sqlWhere = '';	
		if(!isset($_SESSION["admin"])) {
			$sqlWhere .= " WHERE t.user = '".$_SESSION["userid"]."' ";
			if(!empty($_POST["search"]["value"])){
				$sqlWhere .= " and ";
			}
		} else if(isset($_SESSION["admin"]) && !empty($_POST["search"]["value"])) {
			$sqlWhere .= " WHERE ";
		} 		
		$time = new time;  			 
		$sqlQuery = "SELECT t.id, t.uniqid, t.title, t.init_msg as message, t.date, t.last_reply, t.resolved, u.name as creater, u.department as department, u.user_type, t.user, t.user_read, t.admin_read, p.name as priority
			FROM hd_tickets t 
			LEFT JOIN hd_users u ON t.user = u.id
			LEFT JOIN problemas p ON t.problem = p.id 
			LEFT JOIN hd_departments d ON t.department = d.id $sqlWhere ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' (date LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR title LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR resolved LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR last_reply LIKE "%'.$_POST["search"]["value"].'%") ';					
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY resolved ASC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();	
		while ($ticket = mysqli_fetch_assoc($result)) {
			$ticketRows = array();
			$status = '';
			
			switch ($ticket['resolved']) {
				case 0:
					$status = '<span class="text-success">Aberto</span>';
					break;
				case 1:
					$status = '<span class="text-warning">Visto</span>';
					break;
				case 2:
					$status = '<span class="text-danger">Fechado</span>';
					break;
			};
		
			$title = $ticket['title'];
			if ((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) ||
				(!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);
			}
		
			// Verificar se o botão de edição deve ser desabilitado
			$disable = '';
			if (!isset($_SESSION["admin"])) {
				if ($ticket['resolved'] == 1 || $ticket['resolved'] == 2) {
					$disable = 'disabled'; // Desabilita para usuário padrão se resolved for 1
				}
			}
		
			$ticketRows[] = $ticket['id'];
			$ticketRows[] = '<input type="hidden" name="uniqid" value="' . $ticket['uniqid'] . '">';
			$ticketRows[] = $ticket['priority'];
			$ticketRows[] = $title;
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['creater'];
			$ticketRows[] = $time->tempo($ticket['date']);
			$ticketRows[] = $status;
		
			$ticketRows[] = '<a href="view_ticket.php?id=' . $ticket["uniqid"] . '" class="btn btn-sm update" style="background-color:#0089cf; color:white"><i class="bi bi-eye"></i></a>';
		
			// Botão de edição modificado
			$ticketRows[] = '<button type="button" name="update" id="' . $ticket["id"] . '" class="btn btn-secondary btn-sm update" ' . $disable . '><i class="bi bi-pencil-square"></i></button>';
			
			$ticketRows[] = '<button type="button" name="delete" id="' . $ticket["id"] . '" class="btn btn-danger btn-sm deleteT" ' . $disable . '>Fechar</button>';
		
			$ticketData[] = $ticketRows;
		}
			
		
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}	
	public function getRepliedTitle($title) {
		$title = $title.'<span class="answered"><i class="bi bi-chat-dots"> Nova Resposta</i></span>';
		
		return $title; 		
	}
	public function createTicket() {      
		if(!empty($_POST['subject']) && !empty($_POST['message']) && !empty($_POST['priority'])) {                
			$date = new DateTime();
			$date = $date->getTimestamp();
			$uniqid = uniqid();                
			$message = strip_tags($_POST['subject']);              
			$queryInsert = "INSERT INTO ".$this->ticketTable." (uniqid, user, problem, title, init_msg, department, date, last_reply, user_read, admin_read, resolved) 
			VALUES('".$uniqid."', '".$_SESSION["userid"]."', '".$_POST['priority']."', '".$_POST['subject']."', '".$_POST['message']."', '".$_POST['department']."', '".$date."', '".$_SESSION["userid"]."', 0, 0, '".$_POST['status']."')";			
			mysqli_query($this->dbConnect, $queryInsert);			
			echo 'success ' . $uniqid;
		} else {
			echo '<div class="alert error">Por favor preencha todos os campos.</div>';
		}
	}	
	public function getTicketDetails(){
		if($_POST['ticketId']) {	
			$sqlQuery = "
			SELECT * FROM ".$this->ticketTable."
				WHERE id = '".$_POST["ticketId"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function updateTicket() {
		if($_POST['ticketId']) {	
			$updateQuery = "UPDATE ".$this->ticketTable." 
			SET title = '".$_POST["subject"]."', department = '".$_POST["department"]."', init_msg = '".$_POST["message"]."', resolved = '".$_POST["status"]."'
			WHERE id ='".$_POST["ticketId"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}		
	public function closeTicket(){
		if($_POST["ticketId"]) {
			$sqlDelete = "UPDATE ".$this->ticketTable." 
				SET resolved = '2'
				WHERE id = '".$_POST["ticketId"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}	
		
	public function getDepartments() {       
		$sqlQuery = "SELECT * FROM ".$this->departmentsTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($department = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $department['id'] . '">' . $department['name']  . '</option>';           
        }
    }	

	public function getpriority() {       
		$sqlQuery = "SELECT * FROM ".$this->priorityTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while($problem = mysqli_fetch_assoc($result) ) {       
            echo '<option value="' . $problem['id'] . '">' . $problem['name']  . '</option>';           
        }
    }	    
    public function ticketInfo($id) {  		
		$sqlQuery = "SELECT t.id, t.uniqid, t.title, t.user, t.init_msg as message, t.date, t.last_reply, t.resolved, u.name as creater, u.department as department 
			FROM ".$this->ticketTable." t 
			LEFT JOIN hd_users u ON t.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id 
			WHERE t.uniqid = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
        $tickets = mysqli_fetch_assoc($result);
        return $tickets;        
    }    
	public function saveTicketReplies () {
		if($_POST['message']) {
			$date = new DateTime();
			$date = $date->getTimestamp();
			$queryInsert = "INSERT INTO ".$this->ticketRepliesTable." (user, text, ticket_id, date) 
				VALUES('".$_SESSION["userid"]."', '".$_POST['message']."', '".$_POST['ticketId']."', '".$date."')";
			mysqli_query($this->dbConnect, $queryInsert);				
			$updateTicket = "UPDATE ".$this->ticketTable." 
				SET last_reply = '".$_SESSION["userid"]."', user_read = '0', admin_read = '0' 
				WHERE id = '".$_POST['ticketId']."'";				
			mysqli_query($this->dbConnect, $updateTicket);
		} 
	}	
	public function getTicketReplies($id) {  		
		$sqlQuery = "SELECT r.id, r.text as message, r.date, u.name as creater, u.department as department, u.user_type  
			FROM ".$this->ticketRepliesTable." r
			LEFT JOIN ".$this->ticketTable." t ON r.ticket_id = t.id
			LEFT JOIN hd_users u ON r.user = u.id 
			LEFT JOIN hd_departments d ON t.department = d.id 
			WHERE r.ticket_id = '".$id."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
       	$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
        return $data;
    }
	
	public function updateTicketReadStatus($ticketId) {
		// Consulta para verificar o status atual do ticket
		$statusQuery = "SELECT admin_read, resolved FROM ".$this->ticketTable." WHERE id = '".$ticketId."'";
		$statusResult = mysqli_query($this->dbConnect, $statusQuery);
		$ticketData = mysqli_fetch_assoc($statusResult);
		$adminReadStatus = $ticketData['admin_read'];
		$resolvedStatus = $ticketData['resolved'];
	
		// Verifica se o ticket está aberto e se o admin_read é 0
		if ($adminReadStatus == 0 && $resolvedStatus == 0) {
			// Define o campo a ser atualizado
			$updateFields = "admin_read = 1, resolved = 1";
			
			// Atualiza o ticket
			$updateTicket = "UPDATE ".$this->ticketTable." 
				SET ".$updateFields."
				WHERE id = '".$ticketId."'";                
			mysqli_query($this->dbConnect, $updateTicket);
		}
	}
	
	
	
	public function deleteTicket($ticketId) {
		// Consulta SQL para excluir o ticket do banco de dados
		$sqlDelete = "DELETE FROM ".$this->ticketTable." WHERE id = '".$ticketId."'";
		mysqli_query($this->dbConnect, $sqlDelete);
	}

	public function getTicketById($id) {
		$sqlQuery = "SELECT t.id, t.uniqid, t.title, t.init_msg as message, t.date, t.last_reply, t.resolved, 
							u.name as creater, u.department as department, p.name as priority
					 FROM " . $this->ticketTable . " t 
					 LEFT JOIN hd_users u ON t.user = u.id
					 LEFT JOIN problemas p ON t.problem = p.id 
					 LEFT JOIN hd_departments d ON t.department = d.id 
					 WHERE t.id = " . intval($id);
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		return mysqli_fetch_assoc($result);
	}
	
	

	

	
}



