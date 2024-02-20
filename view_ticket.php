<?php
include 'init.php';
if (!$users->isLoggedIn()) {
	header("Location: authenticate.php");
}
include('inc/header.php');
$ticketDetails = $tickets->ticketInfo($_GET['id']);
$ticketReplies = $tickets->getTicketReplies($ticketDetails['id']);
$user = $users->getUserInfo();
$tickets->updateTicketReadStatus($ticketDetails['id']);
?>
<title>Suporte | ENGEBAG E BAGCLEANER</title>
<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<script src="js/refresh.js"></script>

<link rel="stylesheet" href="css/style.css" />

<?php include('inc/nav.php'); ?>
<?php include('inc/container.php'); ?>
<div class="container">
	<section class="comment-list" id="section-resposta">
		<article class="row">
			<div class="col-md-10 col-sm-10">
				<div class="panel panel-default arrow left">
					<div class="panel-heading right">
						<?php if ($ticketDetails['resolved']) { ?>
							<button type="button" class="btn btn-danger btn-sm">
								<span class="bi bi-eye-slash"></span> Fechado
							</button>
						<?php } else { ?>
							<button type="button" class="btn btn-success btn-sm">
								<span class="bi bi-eye"></span> Aberto
							</button>
						<?php } ?>
						<span class="ticket-title"><?php echo $ticketDetails['title']; ?></span>
					</div>
					<div class="panel-body">
						<div class="comment-post">
							<p class="mt-2">
								<?php echo $ticketDetails['message']; ?>
							</p>el-body
						</div>
					</div>
					<div class="panel-heading right">
						<span class="bi bi-clock"></span> <time class="comment-date"><?php echo $time->tempo($ticketDetails['date']); ?></time>
						&nbsp;&nbsp;<span class="bi bi-person-circle"></span> <?php echo $ticketDetails['creater']; ?>
						&nbsp;&nbsp;<span class="bi bi-briefcase"></span> <?php echo $ticketDetails['department']; ?>
					</div>
					<hr>
				</div>
			</div>
		</article>
		<section>
			<?php foreach ($ticketReplies as $replies) { ?>
				<article class="row">
					<div class="col-md-10 col-sm-10">
						<div class="panel panel-default arrow right">
							<div class="panel-heading">
								<?php if ($replies['user_type'] == 'admin') { ?>
									<span class="bi bi-gear"></span> <?php echo 'Suporte'; ?>
								<?php } else { ?>
									<span class="bi bi-person-fill"></span> <?php echo $replies['creater']; ?>
								<?php } ?>
								&nbsp;&nbsp;<time class="comment-date"><i class="bi bi-clock-history"></i> <?php echo $time->tempo($replies['date']); ?></time>
							</div>
							<div class="panel-body">
								<div class="comment-post">
									<?php if ($replies['user_type'] == 'admin') { ?>
										<p class="ms-4 badge text-bg-dark">
											<?php echo $replies['message']; ?>
										</p>
									<?php } else { ?>
										<p class="ms-4 badge text-bg-info">
											<?php echo $replies['message']; ?>
										</p>
									<?php } ?>

								</div>
							</div>

						</div>
					</div>
				</article>
			<?php } ?>
		</section>
	</section>

	<section class="caixaDoFormtxtArea">
		<form method="post" id="ticketReply" class="txtArea">
			<article class="row">
				<div class="col-md-10 col-sm-10">
					<div class="form-group">
						<textarea class="form-control" rows="5" id="message" name="message" placeholder="Escreva sua resposta..." required></textarea>
					</div>
				</div>
			</article>
			<article class="row">
				<div class="col-10 mt-3">
					<button type="submit" name="reply" id="reply" class="btn btn-success" value="Reply"><i class="bi bi-send me-2"></i>Enviar</button>
				</div>
			</article>
			<input type="hidden" name="ticketId" id="ticketId" value="<?php echo $ticketDetails['id']; ?>" />
			<input type="hidden" name="action" id="action" value="saveTicketReplies" />
		</form>
	</section>

	<?php include('add_ticket_model.php'); ?>
</div>
<?php include('inc/footer.php'); ?>

<script>
	var input = document.getElementById("message");
	input.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("reply").click();
		}
	});
</script>