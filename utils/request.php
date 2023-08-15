
 <?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
require_once "db.php";
require_once "function.php";
require_once "event.php";




 if (isset($_POST['adduser'])) {
	$name =$_POST['name'];
	$email =$_POST['email'];
	$phone =$_POST['phone'];
	$password = $_POST['password'];
	$password=md5($password);
	$village_id =$_POST['village_id'];
	$event = new Event;
	if($event->addUser($name,$email,$phone,$password,$village_id)) {
		$event = null;
	 	header("Location: /adminPanel");
	 }
	
}else if(isset($_POST['addData'])) {
	$name =$_POST['name'];
	$age =$_POST['age'];
	$dob =$res = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','-','_' ), ' ', $_POST['dob']);
	$gender =$_POST['gender'];
	$phone =$_POST['phone'];
	$quran_read =$_POST['quran'];
	$education =$_POST['education'];
	$skills =str_replace( array( '\'', '"',
      ',' , ';', '<', '>',',' ), ' ', $_POST['skils']);
	$job =$_POST['jobType'];
	$jameen =$_POST['zameen'];
	$home =$_POST['residentType'];
	$user_id =$_SESSION["userId"];
	$village_id =$_POST['village'];
	$district_id =$_POST['district'];
	$state_id =$_POST['state'];

	// echo "<BR> Name ".$name;
	// echo "<BR> AGE ".$age;
	// echo "<BR> DOB ".$dob;
	// echo "<BR> gender ".$gender;
	// echo "<BR> phone ".$phone;

	// echo "<BR> Quran ".$quran_read;
	// echo "<BR> education ".$education;
	// echo "<BR> skills ".$skills;
	// echo "<BR> job ".$job;
	// echo "<BR> jameen ".$jameen;

	// echo "<BR> home ".$home;
	// echo "<BR> user_id ".$user_id;
	// echo "<BR> village_id ".$village_id;
	// echo "<BR> district_id ".$district_id;
	// echo "<BR> state_id ".$state_id;
	// echo "<BR> PRITING ID : ".$_SESSION["userId"];

	$event = new Event;
	if($event->addData($name ,
						$age,
						$dob,
						$gender ,
						$phone ,
						$quran_read ,
						$education ,
						$skills ,
						$job ,
						$jameen ,
						$home ,
						$user_id ,
						$village_id ,
						$district_id ,
						$state_id)){
		$event = null;
	 	header("Location: /userPanel");
	 }
	


	
}else if(isset($_POST['updateuser'])) {
	$id=$_POST['id'];
	$name =$_POST['name'];
	$email =$_POST['email'];
	$phone =$_POST['phone'];
	$password = $_POST['password'];
	$password=md5($password);
	$village_id =$_POST['village_id'];
	$event = new Event;
	if($event->updateUser($name,$email,$phone,$password,$village_id,$id)) {
		$event = null;
	 	header("Location: /adminPanel");
	 }
	
}else if(isset($_POST['query'])){
	$Name=$_POST['userName'];
	$userMail=$_POST['userMail'];
	$Msg=$_POST['message'];
	$subject="Query From data store";
	// if(sendMail($Name,$userMail,$subject,$Msg)){
	// echo '<script>alert("Thanks! ,we will contact you ASAP!")</script>';
	// 	 header("refresh:0; url=/");
	// }else{
	// 	echo '<script>alert("There is some problem please try after some time!")</script>';
	// 	 header("refresh:0; url=/");
	// }

	echo '<script>alert("There is some problem please try after some time!")</script>';
		 header("refresh:0; url=/");

}


?>
