<nav class="navbar navbar-expand-lg mainbg">
	<div class="container-fluid">
		<a class="navbar-brand" href="ticket.php">
			<img class="logo" src="./img/logobag.png" alt="logo"></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav navBag">
				<li class="nav-item navBag" id="ticket">
					<a class="nav-links navBag" href="ticket.php"><i class="bi bi-journal-text"></i>Tickets</a>
				</li>

				<?php if (isset($_SESSION["admin"])) { ?>
					<li class="nav-item navBag" id="user">
						<a class="nav-links navBag" href="home.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
					</li>

					<li class="nav-item navBag" id="department">
						<a class="nav-links navBag" href="department.php"><i class="bi bi-collection"></i>Departamento</a>

					</li>

					<li class="nav-item navBag" id="user">
						<a class="nav-links navBag" href="user.php"><i class="bi bi-person-vcard"></i>Usuarios</a>

					</li>

					 <li class="nav-item navBag" id="user">
						<a class="nav-links navBag" href="Procedimentos/index.php"><i class="bi bi-code-slash"></i>Projetos</a>

					</li> 
				<?php } ?>
			</ul>
		</div>

		<ul class="nav navbar-nav navbar-right text-light">

			<li class="nav-item navBag me-5">
				<span>Bem vindo,</span>


				<?php if (isset($_SESSION["userid"])) {
					echo $user['name'];
				} ?>
				
				<i class="bi bi-person-circle" style="font-size: 24px; margin-left: 10px"></i>
				
			</li>
			<li class="nav-item navBag" id="user"><a class="btnSair" href="logout.php">Sair</a></li>
		</ul>
	</div>


</nav>