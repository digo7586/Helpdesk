<?php
include '../init.php';
if (!$users->isLoggedIn()) {
	header("Location: login.php");
}
include('../inc/header.php');
$user = $users->getUserInfo();

require_once('../config/conn.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Suporte | Bag Cleaner</title>
</head>

<body>
<nav class="navbar navbar-expand-lg mainbg">
	<div class="container-fluid">
		<a class="navbar-brand" href="../ticket.php">
			<img class="logo" src="../img/logobag.png" alt="logo"></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

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
						<a class="nav-link navBag" href="index.php"><i class="bi bi-code-slash"></i>Procedimentos</a>

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
				
				<i class="bi bi-person-circle" style="font-size: 24px;"></i>
				
			</li>
			<li class="nav-item navBag" id="user"><a class="btnSair" href="logout.php">Sair</a></li>
		</ul>
	</div>


</nav>
    <div class="container">
       
        <h1>Procedimentos</h1>
        <p>Abaixo estão descritos os procedimentos feitos para execução de tarefas, instalação de programas e atualizações</a>
    </div>

    <div class="blank"></div>
    
    <div class="container second">
       
        <div class="card">
            <div class="card-title">
                Instalar RM
            </div>
            <div class="info">
                <img src="image/totvs.jpg">
                <h3>RM</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem unde ratione fugiat.</p>
            </div>
            <a href="#">Learn More</a>
        </div>
        <div class="card">
            <div class="card-title">
                Configurar xampp
            </div>
            <div class="info">
                <img src="image/xamp.png">
                <h3>XAMPP / SQL</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem unde ratione fugiat.</p>
            </div>
            <a href="#">Learn More</a>
            
        </div>
       <!--  <div class="card">
            <div class="card-title">
                Atualizar Site
            </div>
            <div class="info">
                <img src="image/contact.jpg">
                <h3>Site Bag Cleaner</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem unde ratione fugiat.</p>
            </div>
            <a href="#">Learn More</a>
        </div> -->
       
    </div>

    <div class="blank-2">
        <div class="footer">
            <div class="column">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Email Marketing</a></li>
                    <li><a href="#">Campaigns</a></li>
                    <li><a href="#">Branding</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>About</h3>
                <ul>
                    <li><a href="#">Our Story</a></li>
                    <li><a href="#">Benifits</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Overview</h3>
                <ul>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Bloggers</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>