
<?php
 if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }


class dataBase
{

	private $conn;
	function makeConnection()
	{
		$server = "127.0.0.1";
		$user = "root";
		$dbName = "populationdb";
		$this->conn = new mysqli($server, $user, "", $dbName);
		if ($this->conn->connect_error)
		{
			error_log("Failed to connect to database!", 0);
		}
	}
	function query($sql)
	{
		$result = $this->conn->query($sql);
		if ($result)
		{
			return $result;
		} 
		else
		{
			
			error_log($sql . "<br> " . $this->conn->error, 0);
		}
	}

	function close()
	{
		$this->conn->close();
	}

}

?>
