$(document).ready(function() {        
	
	var departmentData = $('#listDepartment').DataTable({
		"searching": false,
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"department_action.php",
			type:"POST",
			data:{action:'listDepartment'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		"pageLength": 7
	});	

	$(document).on('click', '.update', function(){
		var departmentId = $(this).attr("id");
		var action = 'getDepartmentDetails';
		$.ajax({
			url:'department_action.php',
			method:"POST",
			data:{departmentId:departmentId, action:action},
			dataType:"json",
			success:function(data){
				$('#departmentModal').modal('show');
				$('#departmentId').val(data.id);
				$('#department').val(data.name);
				$('#status').val(data.status);				
				$('.modal-title').html("<i class='bi bi-pencil-square'></i> Editar Departamento");
				$('#action').val('updateDepartment');
				$('#save').val('Save');
			}
		})
	});		
	
	$('#addDepartment').click(function(){
		$('#departmentModal').modal('show');
		$('#departmentForm')[0].reset();
		$('.modal-title').html("<i class='bi bi-plus'></i>Setor");
		$('#action').val('addDepartment');
		$('#save').val('Save');
	});	
		
	$(document).on('submit','#departmentForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"department_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#departmentForm')[0].reset();
				$('#departmentModal').modal('hide');				
				$('#save').attr('disabled', false);
				departmentData.ajax.reload();
			}
		})
	});			
			
	$(document).on('click', '.deleteD', function(){
		var departmentId = $(this).attr("id");		
		var action = "deleteDepartment";
		if(confirm("Tem certeza de que deseja excluir este registro?")) {
			$.ajax({
				url:"department_action.php",
				method:"POST",
				data:{departmentId:departmentId, action:action},
				success:function(data) {					
					departmentData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
    
});

