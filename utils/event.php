 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

 if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }

require_once "db.php";
require_once "function.php";

class Event
{	
	
	public function addUser($name,$email,$phone,$password,$village_id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "INSERT INTO users(user_name,user_email,user_phone,password,user_village_id) values('$name','$email','$phone','$password','$village_id')";
		$result = $db->query($sql);

		$db->close();
		if ($result) return true;
	}

	public function updateUser($name,$email,$phone,$password,$village_id,$id){

			$db = new dataBase;
		$db->makeConnection();
			$sql = "UPDATE users SET user_name='$name',user_email='$email',
		user_phone='$phone',password='$password',user_village_id='$village_id'
		 WHERE user_id ='$id'";
			$result = $db->query($sql);
			$db->close();
			if($result)
				return 1;
			
	}

	 public function getAllUsers(){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM users";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	public function userLogin($email,$password){
		$db = new database;
		$db->makeConnection();
		$sql = "SELECT * FROM users WHERE user_email='$email'";
			$result = $db->query($sql);
			$db->close();
			if(mysqli_num_rows($result)){
				$row = $result->fetch_assoc();
				$arrayVariable = [
						 'userId' => $row['user_id'],
					    'name'  => $row['user_name'],
					    'email' =>  $row['user_email'],
					    'password' =>  $row['password'],
					    'role' => $row['role']
					];
				return $arrayVariable;
			}
			else{
				return 0;
			}
	}


	public function addData($name ,
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
						$state_id){


 		$db = new dataBase;
		$db->makeConnection();
		$sql = "INSERT INTO data(name,age,dob,gender,phone,quran_read,education,
								skills,job,jameen,home,user_id,village_id,
								district_id,state_id) values('$name','$age','$dob','$gender',
								'$phone','$quran_read','$education','$skills','$job','$jameen','$home','$user_id',1,
								6,1)";
		$result = $db->query($sql);

		$db->close();
		if ($result) return true;
		
	 }
	 public function getDataById($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM data WHERE id='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	 public function getUserByUserId($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM users WHERE user_id='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}

	 public function getDataByUserId($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM data WHERE user_id='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}


	public function getAllData(){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * 
		FROM data AS d LEFT JOIN users AS u ON d.user_id=u.user_id";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}

	public function getAllState(){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM state";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	public function getAllDistrict(){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM district";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	public function getAllVillege(){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM village";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}

	public function getAllDistrictByStateId($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM district WHERE state_id ='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	public function getAllVillegeByDistrictId($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM village WHERE district_id='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}

	public function getDataByVillageId($id){
		$db = new dataBase;
		$db->makeConnection();
		$sql = "SELECT * FROM data WHERE village_id='$id'";
		$result = $db->query($sql);
		$db->close();
		$data = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($data, $row);
			$row = $result->fetch_assoc();
		}
		return $data;
	}
	

}

?>