<?php
include 'init.php';
if ($users->isLoggedIn()) {
	header('Location: ticket.php');
}
$errorMessage = $users->login();

?>
<?php
include('inc/header.php');
?>
<link rel="stylesheet" href="css/styleChat.css">

<body>
	<div class="circle"></div>
	<div class="circle1"></div>

	<div class="wrapper">
		<section class="form login">
			<header>
					<img class="iconeBag" src="./img/icone.ico" alt="">				
			</header>
			<form id="loginform" role="form" method="POST" action="#">
				<div class="error-text"></div>
				<div class="field input">
					<label>Email</label>
					<input type="text" id="email" name="email" placeholder="Digite seu email" required>
				</div>
				<div class="field input">
					<label>Senha</label>
					<input type="password" id="password" name="password" placeholder="Digite sua senha" required>
					<i class="bi bi-eye"></i>
				</div>
				<div class="field button">
					<input type="submit" name="login" value="Login">
				</div>
			</form>
			<!-- <p>Não tem uma conta? <a target="_blank" href="cadastrarUsuario.php" style="color:  #67a2d8;">Inscreva-se agora</a>.</p> -->
			<div class="copyright">
				<span>&copy; Suporte T.I</span>
			</div>
		</section>
	</div>

	<script src="chatw/javascript/pass-show-hide.js"></script>
</body>
</html>