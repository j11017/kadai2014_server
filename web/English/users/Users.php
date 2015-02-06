<?php
    require "./MySQL.php";
    
    class Users extends MySQL {
        
        private $status = 0;
        
        public function __construct() {
            parent::__construct();
            session_start();
        }
        
        public function login($name, $pass) {
            
            if(isset($_SESSION["name"])) {
                $this->status = 1;
                
                session_regenerate_id(true);
            } else if (!empty ($name) && !empty($pass)) {
                $stmt = parent::$this->mysqli->prepare("SELECT * FROM users WHERE name = ? AND pass = ?");
                $stmt->bind_param('ss', $name, $pass);
                $stmt->execute();
                
                $stmt->store_result();
                if($stmt->num_rows == 1) {
                    $this->status = 2;
                    $_SESSION["name"] = $name;
                    session_regenerate_id(true);
                } else {
                    $this->status = 0;
                }
                return $this->status;
            }
        }
        
        public function logout() {
            $_SESSION = array();
            session_destroy();
        }
        
        public function logincheck() {
            if (isset ($_SESSION["name"]))
                $this->status = 1;
            return $this->status;
        }
    
    }
?>