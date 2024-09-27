<?php 

    require_once 'connection.php';

    class Account {
        public $id = '';
        public $first_name = '';
        public $last_name = '';
        public $username = '';
        public $password = '';
        public $role = '';
        public $is_staff = true;
        public $is_admin = false;

        protected $db;

        function __construct(){
            $this->db = new Database();
        }
    
        function add(){
            $sql = "INSERT INTO account (first_name, last_name, username, password, role, is_staff, is_admin) VALUES (:first_name, :last_name, :username, :password, :role, :is_staff, :is_admin);";
            $query = $this->db->connection()->prepare($sql);
    
            $query->bindParam(':first_name', $this->first_name);
            $query->bindParam(':last_name', $this->last_name);
            $query->bindParam(':username', $this->username);
            $hashpassword = password_hash($this->password, PASSWORD_DEFAULT);
            $query->bindParam(':password', $hashpassword);
            $query->bindParam(':role', $this->role);
            $query->bindParam(':is_staff', $this->is_staff);
            $query->bindParam(':is_admin', $this->is_admin);
    
            return $query->execute();
        }
    }  
?>