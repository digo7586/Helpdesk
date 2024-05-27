<nav class="navbar navbar-expand-lg mainbg text-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="ticket.php">
			<img class="logo" src="../img/logobag.png" alt="logo"></a>

		

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav navBag">
			  	<li class="nav-item navBag" id="ticket">
					<a class="nav-link navBag" href="../ticket.php"><i class="bi bi-journal-text"></i>Tickets</a>
				</li>

				<?php if (isset($_SESSION["admin"])) { ?>
					<li class="nav-item navBag" id="user">
						<a class="nav-link navBag" href="../home.php"><i class="bi bi-speedometer2"></i>Dashboard</a>
					</li>

					<li class="nav-item navBag" id="department">
						<a class="nav-link navBag" href="../department.php"><i class="bi bi-collection"></i>Departamento</a>
						
					</li>

					<li class="nav-item navBag" id="user">
						<a class="nav-link navBag" href="../user.php"><i class="bi bi-person-vcard"></i>Usuarios</a>
						
					</li>

					<li class="nav-item navBag" id="user">
						<a class="nav-link navBag" href="#"><i class="bi bi-code-slash"></i>Projetos</a>
						
					</li>
				<?php } ?>
			</ul>
		</div>

		<ul class="nav navbar-nav navbar-right">
			<li class="nav-item navBag">

				<?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
				$row = mysqli_fetch_assoc($sql);
            }
			?>
          <img src="php/images/<?php echo $row['img']; ?>" class="perfil" alt="">
			</li>
			<li>
          <div class="details navUser">
			  <span class="me-4"><?php echo $row['fname']. " " . $row['lname'] ?></span>
			  <p class="me-4"><?php echo $row['status']; ?></p>
		  </div>
			</li>
<li class="nav-item navBag">
<a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="btn btn-dark">Sair</a>
</li>
			<!-- <li class="nav-item navBag" id="user"><a class="btnSair" href="logout.php">Sair</a></li> -->
		</ul>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"  aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
	
	
</nav>