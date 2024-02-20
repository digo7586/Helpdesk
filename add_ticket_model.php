<div id="ticketModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="ticketForm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="bi bi-plus"></i> Abrir Chamado</h4>
				</div>
				<div class="modal-body">
					<div class="form-group mb-1">
						<label for="subject" class="control-label mb-1">Ocorrência</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Titulo do chamado" required>
					</div>
					<div class="form-group mb-1">
						<label for="department" class="control-label mb-1">Setor</label>
						<select id="department" name="department" class="form-control" placeholder="Departmento...">
							<?php $tickets->getDepartments(); ?>
						</select>
					</div>
					<div class="form-group mb-1">
						<label for="message" class="control-label">Mensagem</label>
						<textarea class="form-control" rows="5" id="message" name="message" placeholder="Descreva...">
							 
						</textarea>
					</div>

					
				
					<div class="form-check form-check-inline">

						<label for="status" class="form-check-label">Status/</label>
						<label class="radio">
							<input type="radio" name="status" id="open" value="0" checked required>Open
						</label>
					</div>
						<div class="form-check form-check-inline">
						<?php if (isset($_SESSION["admin"])) { ?>
							<label class="radio">
								<input type="radio" name="status" id="close" value="1" required>Close
							</label>
						<?php } ?>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="ticketId" id="ticketId" />
					<input type="hidden" name="action" id="action" value="" />
					<button type="submit" name="save" id="save" class="btn btn-primary" value="Save">Salvar</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</form>
	</div>
</div>