
 <?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
require_once "db.php";
require_once "function.php";
require_once "event.php";

 if (isset($_POST['login'])) {
	$email =$_POST['email'];
	$password = $_POST['password'];
	$password=md5($password);


		$event = new Event;
		
		$userdata=$event->userLogin($email,$password);
		 if($userdata) {
			$event = null;
			$userId=$userdata['userId'];
			$Name=$userdata['name'];
			$Email=$userdata['email'];
			$password1=$userdata['password'];
			$role=$userdata['role'];

	  		if($password1==$password){
	  			$_SESSION["userId"] =$userId;
	  			$_SESSION["Name"] =$Name;
	  			$_SESSION["Email"] = $Email;
	  			$_SESSION["Role"] =$role;

	  			if($role==2){
	  			header("Location: /userPanel");
	  			}else if($role==1){
	  			header("Location: /adminPanel");
	  			}

	  		}else{
	  			echo '<script>alert("Invalid Email or password!")</script>';
		 		header("refresh:0; url=/login");
	  		}
		}else{
	  			echo '<script>alert("Invalid Email or password!")</script>';
		 		header("refresh:0; url=/login");
	  		}
	 
	
}


?>
