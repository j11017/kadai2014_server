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
        
        public function select_game($id) {
            $result = $this->mysqli->query("SELECT * FROM games WHERE game_id = $id");
            return $result;
        }
        
        public function select_record($id) {
            $result = $this->mysqli->query("SELECT * FROM records WHERE game_id = $id ORDER BY move ASC");
            return $result;
        }
        
        public function selectAll($table){
            $result = $this->mysqli->query("SELECT * FROM $table ORDER BY game_id DESC");
            return $result;
        }
        
        public function delete($game_id) {
        	$stmt = $this->mysqli->prepare("DELETE FROM records WHERE game_id = ?");
            $stmt->bind_param('i', $game_id);
            $stmt->execute();
            
            $stmt = $this->mysqli->prepare("DELETE FROM games WHERE game_id = ?");
            $stmt->bind_param('i', $game_id);
            $stmt->execute();
        }
    }
?>