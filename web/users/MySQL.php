<?php
    
    class MySQL {
        
        private $host;
        private $user;
        private $pass;
        private $dbname;
        protected $mysqli;
        
        public function __construct() {
            $this->host = "localhost";
            $this->user = "j11017";
            $this->pass = "j11017";
            $this->dbname = "j11017";
            
            $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            $this->mysqli->set_charset("utf8");
            if ($this->mysqli->connect_error) {
                print("接続失敗 : " .$this->mysqli->connect_error);
                exit();
            }
        }
        
        public function __destruct() {
            $this->mysqli->close();
        }
        
        public function select($name) {
            $result = $this->mysqli->query("SELECT * FROM users WHERE name = '$name'");
            return $result;
        }
        
        public function selectAll() {
            $result = $this->mysqli->query("SELECT * FROM users");
            return $result;
        }
        
        public function add($name, $pass) {
            if(!empty($name) && !empty($pass)) {
                if(!preg_match('/^[0-9a-zA-z]{2,32}$/', $name))
                    $_SESSION["register"] = "error_username";
                else if(!preg_match('/^[0-9a-zA-z]{8,32}$/', $pass))
                    $_SESSION["register"] = "error_password";
                else {
                    $stmt = $this->mysqli->prepare("INSERT INTO users (name, pass) VALUES (?, ?)");
                    $stmt->bind_param('ss', $name, $pass);
                    if ($stmt->execute())
                        $_SESSION["register"] = "ok";
                    else
                        $_SESSION["register"] = "failed";
                }
            }
        }
        
        public function delete($name) {
            $stmt = $this->mysqli->prepare("DELETE FROM users WHERE name = ?");
            $stmt->bind_param('s', $name);
            $stmt->execute();
        }
        
        public function update($name, $pass) {
            $stmt = $this->mysqli->prepare("UPDATE users SET name = ?, pass = ? WHERE name = ?");
            $stmt->bind_param('sss', $name, $pass, $name);
            $stmt->execute();
        }
        
        public function nameCheck($name) {
            $sql = 'select * from j11017_users where name = "'.$name.'";';
            $rs = mysqli_query($this->mysqli, $sql);
            $rows = mysqli_num_rows($rs);
            return $rows;
        }
        
    }
    
?>