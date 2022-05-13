<!doctype html>
<html lang="en">
  <head>
  	<title>EDUHACKS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">

	</head>
	<body class="back">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h1  class="titol">EDUHACKS</h1>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap py-5">
		      	<div class="img d-flex align-items-center justify-content-center" style="background-image: url(./logoeducem.png);"></div>
		      	<h3 class="text-center mb-0">Benvinguts</h3>
		      	<p class="text-center">Inicieu sessió ingressant la informació a continuació</p>
				<form method="post" action="./validarPass.php" class="login-form">
							
		      		<div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
		      			<input name="newPass" type="password" class="form-control" placeholder="New Password" required>
		      		</div>
	            <div class="form-group">
	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
	              <input name="confPass" type="password" class="form-control" placeholder="Confirm the password" required>
	            </div>
	            <div class="form-group">
	            	<button type='submit' class="btn form-control btn-primary rounded submit px-3">Change Password</button>
	            </div>
	          </form>
	          <div class="w-100 text-center mt-4 text">
	          	<p class="mb-0">Encara no tens compte?</p>
		          <a href="create-user.php">Registrat! Es gratis.</a>
	          </div>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>
