<!DOCTYPE html>
<html>
<head>
  <title>Tweeter data annotation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script>
</head>
<body>
	<?php 
		$username = ['us1','us2','us3','us4'];
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['login'])){
			$uname = $_POST['username'];
			if($uname != "" ){
				if(in_array($uname, $username)){
					$url = "sur.php";
					$url = "?username=" .$uname;
  					header("Location: sur.php " .$url);
  					exit();				
  			}else{
  				$error = "Invalid username";
  			}
		}else{
			$error = "Please enter your username";
		}
	  }
	}
	?>
	<div class="card bg-success text-center border border-danger" style="width: 100rem; margin: 0 auto; float: none;  margin-bottom: 10px;">
  <div class="card-body" style="width: 100rem; margin: 0 auto; float: none;  margin-bottom: 10px; margin-top: 10%">
  	<p style="font-size: 30px;   line-height: 1.5;   text-align: justify; padding: 10%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Id ornare arcu odio ut sem. Ut placerat orci nulla pellentesque. Ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget gravida. Bibendum neque egestas congue quisque.</p>
  	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="text" name="username" class="form-control input-lg" style="width: 400px; margin: 0 auto; float: none;  margin-bottom: 10px; "><br>
		<input type="submit"  name="login" value="Login" class="btn btn-lg btn-primary" style="margin-bottom: 10%">
		<?php if(isset($error)){
				echo $error;
		} ?>

	</form>
  </div>
</div>
</body>
</html>