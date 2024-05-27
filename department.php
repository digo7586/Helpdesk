<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
include('inc/header.php');
$user = $users->getUserInfo();
?>
<title>Suporte | ENGEBAG E BAGCLEANER</title>
<link rel="shortcut icon" href="icone.ico">
<script src="js/jquery.dataTables.min.js"></script>

<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> -->
<script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"></script>

<script src="js/general.js"></script>

<script src="js/department.js"></script>

<link rel="stylesheet" href="css/style.css" />

<?php include('inc/nav.php'); ?>
<?php include('inc/container.php'); ?>
<div class="container-fluid">
	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2" align="right">
				<button type="button" name="add" id="addDepartment" class="btn btn-success btn-md"><i class="bi bi-plus"></i>Setor</button>
			</div>
		</div>
	</div>

	<table id="listDepartment" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>N°</th>
				<th>Departamento</th>
				<th>Status</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
	</table>

	<div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus"></i></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" id="departmentForm">
						<div class="mb-3">
							<label for="department" class="control-form-label">Departamento:</label>
							<input type="text" class="form-control" id="department" name="department"required>
						</div>
						<div class="mb-3">
							<label for="status" class="control-label">Status</label>
							<select id="status" name="status" class="form-control">
								<option value="1">Aberto</option>
								<option value="0">Fechado</option>
							</select>
						</div>
						
						<div class="modal-footer">
							<input type="hidden" name="departmentId" id="departmentId" />
							<input type="hidden" name="action" id="action" value="" />
							<button type="submit" name="save" id="save" class="btn btn-primary" value="Save">Adicionar</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>
