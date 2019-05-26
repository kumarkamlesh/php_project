<?php
	//Message vars
	$msg = '';
	$msgClass = '';
	//Check for submit
	if(filter_has_var(INPUT_POST, 'submit')){
		//Get form data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		//Check required fields
		if(!empty($name) && !empty($email) && !empty($message)){
			//check email validate
			if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
				$msg = 'Please currect the email';
				$msgClass = 'alert-danger';
			} else{
				$toEmail = 'kamleshkumarbca92@gmail.com';
				$subject = 'Contact request form' .$name;
				$body = '<h2>Contact Request</h2>
						<h4>Name</h4> <p> ' .$name. '</p>
						<h4>Email</h4> <p> ' .$email. '</p>
						<h4>Message</h4> <p> ' .$message. '</p>
						';
				//email header
				$headers = "MINE-Version: 1.0" ."\r\n";
				$headers .= "Content-Type:text/html;charset=UTF-8" ."\r\n";

				//additional header
				$headers .= "Form: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					$msg = 'Your mail has been sent';
					$msgClass = 'alert-success';

				}else{
					$msg = 'Your mail not sent';
					$msgClass = 'alert-danger';

				}

			}

		}else{
			$msg = 'Please fill all fields';
			$msgClass = 'alert-danger';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<?php if($msg !='') : ?>
				<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?>
					
				</div>

			<?php endif; ?>
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">My website</a>				
			</div>			
		</div>		
	</nav>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">			
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">			
		</div>
		<div class="form-group">
			<label>Message</label>
			<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
		</div>
		<br>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>		
	</form>
</body>
</html>