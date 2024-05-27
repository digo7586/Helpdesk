$(document).ready(function() {     
    $(document).on('submit','#ticketReply', function(event) {
		event.preventDefault();
		$('#reply').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"ticket_action.php",
			method:"POST",
			data:formData,
			success:function(data) {				
				$('#ticketReply')[0].reset();
				$('#reply').attr('disabled', false);
				location.reload();
			}
		})
	});		


	$('#createTicket').click(function() {
		$('#ticketModal').modal('show');
		$('#ticketForm')[0].reset();
		$('.modal-title').html("<i class='bi bi-plus'></i>Abrir Chamado");
		$('#action').val('createTicket');
		$('#save').val('Save Ticket');
	});	


	if($('#listTickets').length) {
		var ticketData = $('#listTickets').DataTable({
			"lengthChange": false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"ticket_action.php",
				type:"POST",
				data:{action:'listTicket'},
				dataType:"json"
			},
			"columnDefs":[
				{
					"targets":[0,7,8,9,10],
					"orderable":false,
				},
			],
			"pageLength": 10
		});		

		$(document).on('submit','#ticketForm', function(event){
			event.preventDefault();
			$('#save').attr('disabled','disabled');
			var formData = $(this).serialize();
			$.ajax({
				url:"ticket_action.php",
				method:"POST",
				data:formData,
				success:function(data){				
					$('#ticketForm')[0].reset();
					$('#ticketModal').modal('hide');				
					$('#save').attr('disabled', false);
					ticketData.ajax.reload();
				}
			})
		});		

		$(document).on('click', '.update', function(){
			var ticketId = $(this).attr("id");
			var action = 'getTicketDetails';
			$.ajax({
				url:'ticket_action.php',
				method:"POST",
				data:{ticketId:ticketId, action:action},
				dataType:"json",
				success:function(data){
					$('#ticketModal').modal('show');
					$('#ticketId').val(data.id);
					$('#subject').val(data.title);
					$('#priority').val(data.problem);
					$('#message').val(data.init_msg);
					if(data.gender == '0') {
						$('#open').prop("checked", true);
					} else if(data.gender == '1') {
						$('#visto').prop("checked", true);
					}  else if(data.gender == '2') {
						$('#close').prop("checked", true);
					} 
					$('.modal-title').html("<i class='bi bi-pencil-square'></i> Editar Chamado");
					$('#action').val('updateTicket');
					$('#save').val('Save Ticket');
				}
			})
		});		

		$(document).on('click', '.deleteT', function(){
			var ticketId = $(this).attr("id");		
			var action = "closeTicket";
			if(confirm("Tem certeza que deseja fechar este ticket?")) {
				$.ajax({
					url:"ticket_action.php",
					method:"POST",
					data:{ticketId:ticketId, action:action},
					success:function(data) {					
						ticketData.ajax.reload();
						ticketID.ajax.reload();
						reload();
					}
				})
			} else {
				return false;
			}
		});	


		

    }

});

