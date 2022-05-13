<!doctype html>
<html lang="en">
  <head>
  	<title>EDUHACKS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="back">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2  class="titol">EDUHACKS - REGISTER</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap py-5">
		      	<div class="img d-flex align-items-center justify-content-center" style="background-image: url(./images/logoeducem.png);"></div>
		      	<h3 class="text-center mb-0">REGISTRE</h3>
		      	<p class="text-center">Sign in by entering the information below</p>

				<form method="post" action="./validarusers.php" class="login-form">
                    <div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input name="user" type="text" class="form-control" placeholder="Username" required>
		      		</div>
		      		<div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input name="mail" type="text" class="form-control" placeholder="Email" required>
		      		</div>
                    <div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input name="nom" type="text" class="form-control" placeholder="First Name" required>
		      		</div>
                    <div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input name="cognom" type="text" class="form-control" placeholder="Last Name" required>
		      		</div>
	            <div class="form-group">
	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
	              <input name="pass" type="password" class="form-control" placeholder="Password" required>
                  <div class="form-group">
	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
	              <input name="verPass" type="password" class="form-control" placeholder="Verify Password" required>
	            </div>
	            </div>

	            <div class="form-group">
	            	<button type="submit" class="btn form-control btn-primary rounded submit px-3">Registre</button>
	            </div>
	          </form>
	          <div class="w-100 text-center mt-4 text">
	          	<p class="mb-0">Un cop registrat</p>
		          <a href="index.php">Iniciar Sessió</a>
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

