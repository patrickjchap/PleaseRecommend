<?php

	class Dao {
		private $host = "localhost";
		private $db = "mysql";
		private $user = "root";
		private $password = "";
		
		public function getConnection() {
			try{
				$conn = new PDO("mysql:host={$this->host};
				dbname={$this->db}", $this->user,
				$this->password);
			} catch (Exception $e) {
				echo "database connection error";
				exit;
			}
			return $conn;
		}
		
		public function createUser($newUser, $newPassword, $newEmail,
		$newFName, $newLName) {
			$conn = $this->getConnection();
			$q = $conn->prepare("INSERT INTO pr_user (USER_EMAIL, USER_FNAME,
			USER_LNAME, USER_NAME, USER_PASSWORD) VALUES ('$newEmail',
			'$newFName', '$newLName', '$newUser', '$newPassword')");
	
			return $conn->query($q);
		}
		
		public function getNumUser($qUsername) {
			$conn = $this->getConnection();
			$q = $conn->prepare("SELECT COUNT(*) FROM pr_user 
			WHERE USER_NAME = '$qUsername'");
			
			$q->execute();
			$rowCount = $q->fetchColumn(0);
			
			return $rowCount;
			
		}
		
		public function getNumEmail($qEmail) {
			$conn = $this->getConnection();
			$q = $conn->prepare("SELECT COUNT(*) FROM pr_user 
			WHERE USER_EMAIL = '$qEmail'");
			
			$q->execute();
			$rowCount = $q->fetchColumn(0);
			
			return $rowCount;
			
		}
		
		public function getNumUserWithPass($qUsername, $qPassword){
			$conn = $this->getConnection();
			$q = $conn->prepare("SELECT COUNT(*) FROM pr_user WHERE
			USER_NAME = '$qUsername' and USER_PASSWORD = '$qPassword'");
			
			$q->execute();
			$rowCount = $q->fetchColumn(0);
			
			return $rowCount;	
		}
        
        public function getUserEmail($qUsername){
            $conn = $this->getConnection();
			$q = $conn->prepare("SELECT USER_EMAIL FROM pr_user WHERE
			USER_NAME = '$qUsername'");
			
			$q->execute();
			$ret = $q->fetchColumn();
			
			return $ret;
        }
        
        public function getUserFName($qUsername) {
            $conn = $this->getConnection();
			$q = $conn->prepare("SELECT USER_FNAME FROM pr_user WHERE
			USER_NAME = '$qUsername'");
			
			$q->execute();
            $ret = $q->fetchColumn();
			
			return $ret;
        }
        
        public function getUserJson($qUsername){
                $conn = $this->getConnection();
                $q = $conn->prepare("SELECT USER_MOVIES FROM pr_user WHERE
                USER_NAME = '$qUsername'");
                
                $q->execute();
                $ret = $q->fetchColumn();
                return $ret;
        }
        
        public function setUserRating($username, $json){
                $conn = $this->getConnection();
                $q = $conn->prepare("UPDATE pr_user SET USER_MOVIES = '$json' WHERE
                USER_NAME = '$username'");
                
                $q->execute();
                
        }
		
	}

?>