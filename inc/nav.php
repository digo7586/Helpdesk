<nav class="navbar navbar-expand-lg mainbg">
	<div class="container-fluid">
		<a class="navbar-brand" href="ticket.php">
			<img class="logo" src="./img/logobag.png" alt="logo"></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"  aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav navEng">
			  	<li class="nav-item navEng" id="ticket">
					<a class="nav-link navEng" href="ticket.php"><i class="bi bi-journal-text"></i>Tickets</a>
				</li>

				<?php if (isset($_SESSION["admin"])) { ?>
					<li class="nav-item navEng" id="user">
						<a class="nav-link navEng" href="home.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
					</li>

					<li class="nav-item navEng" id="department">
						<a class="nav-link navEng" href="department.php"><i class="bi bi-collection"></i>Departamento</a>
						
					</li>

					<li class="nav-item navEng" id="user">
						<a class="nav-link navEng" href="user.php"><i class="bi bi-person-vcard"></i>Usuarios</a>
						
					</li>

					<li class="nav-item navEng" id="user">
						<a class="nav-link navEng" href="#"><i class="bi bi-code-slash"></i>Projetos</a>
						
					</li>
				<?php } ?>
			</ul>
		</div>

		<ul class="nav navbar-nav navbar-right">

			<?php if (isset($_SESSION["userid"])) {
				echo $user['name'];
			} ?>

			<li class="nav-item navEng" id="user"><a class="btnSair" href="logout.php">Sair</a></li>
		</ul>
	</div>

	
</nav>