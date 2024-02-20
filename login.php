<?php
include 'init.php';
if ($users->isLoggedIn()) {
	header('Location: ticket.php');
}
$errorMessage = $users->login();
include('inc/header.php');
?>
<title>Suporte | ENGEBAG E BAGCLEANER</title>
<?php include('inc/container.php'); ?>
<!-- <link rel="stylesheet" href="./css/menuLogin.css"> -->
<link rel="stylesheet" href="css/styleLogin.css">



<div class="circle"></div>
<div class="circle1"></div>
	<div class="card1">
		<div class="logo"><img class="iconeBag" src="./img/icone.ico" alt="">
	</div>
		<h2>Suporte T.I</h2>

		<?php if ($errorMessage != '') { ?>
			<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>
		<?php } ?>

		<form class="form" id="loginform"  role="form" method="POST" action="">
				<input type="text" id="email" name="email" placeholder="Digite seu email" required>
				<i class="bi bi-person-fill"></i>
			
				<input type="password" id="password" name="password" placeholder="Digite sua senha" required>
				<i class="bi bi-file-lock2-fill"></i><i class="bi bi-eye-slash" onmouseup="passaMouseMostraSenhaLogin();" onmousedown="tiraMouseEscondeSenha();" id="closeEye"></i>
				
					<button type="submit" name="login" value="Login">Entrar</button>
				
			<!-- <p>Não tem uma conta? <a target="_blank" href="cadastrarUsuario.php" style="color:  #67a2d8;">Inscreva-se agora</a>.</p> -->
			<div class="copyright">
				<span>&copy; Suporte T.I</span>
			</div>
		</form>
	</div>
	
</div>