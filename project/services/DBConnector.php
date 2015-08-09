<?php
	class DBConnector{
		private $host = "sql2.freesqldatabase.com:3306";
		private $dbuser = "sql286113";
		private $dbpasswd = "zE9!wU1%";
		private $dbname = "sql286113";
		private $db = null;

		public function connect(){
			if(!$this->db){
				$this->db = mysqli_connect($this->host, $this->dbuser, $this->dbpasswd, $this->dbname);

				if(!$this->db){
					throw new Exception(mysqli_connect_error());
				}
			}
			return $this->db;
		}
	}
?>