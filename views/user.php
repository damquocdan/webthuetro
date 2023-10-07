<?php
    
    include'../controllers/user_controller.php';
    UserController::checkLogin();
    
    include '../modules/database.php';
    include '../modules/format.php';
    
?>
<?php
     class user
     {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_user($userEmail,$userPass)
        {
            $userEmail = $this->fm->validation($userEmail);
            $userPass = $this->fm->validation($userPass);
            $userEmail = mysqli_real_escape_string($this->db->link,$userEmail);
            $userPass = mysqli_real_escape_string($this->db->link,$userPass);
            
            $query = "SELECT * FROM tbl_user WHERE user_email='$userEmail' AND user_password = '$userPass' LIMIT 1 ";
            $result = $this->db->select($query);
            if($result != false){
                $value = $result->fetch_assoc();
                UserController::set('userlogin',true);
                UserController::set('userid',$value['user_id']);
                UserController::set('userphone',$value['user_phone']);
                UserController::set('username',$value['user_name']);
                UserController::set('useraddress',$value['user_address']);
                header('Location:index.php');
            } else {
                $alert = "email or password not match";
                return $alert;
            }
        }
        public function login_admin($adminEmail,$Pass)
        {
            
            $adminEmail = $this->fm->validation($adminEmail);
            $Pass = $this->fm->validation($Pass);
            $adminEmail = mysqli_real_escape_string($this->db->link,$adminEmail);
            $Pass = mysqli_real_escape_string($this->db->link,$Pass);
            
            $query = "SELECT * FROM tbl_user WHERE user_email='$adminEmail' AND user_password = '$Pass' AND user_id = 1 ";
            $result = $this->db->select($query);
            if($result != false){
                $value = $result->fetch_assoc();
                UserController::set('adlogin',true);
                UserController::set('userid',$value['user_id']);
                UserController::set('userphone',$value['user_phone']);
                UserController::set('username',$value['user_name']);
                UserController::set('useraddress',$value['user_address']);
                header('Location:index.php');
            } else {
                $alert = "email or password not match";
                return $alert;
            }
        }
        
        public function insert_user($user_email,$user_password,$user_phone,$user_name, $user_address){
            $user_email = mysqli_real_escape_string($this->db->link,$user_email);
            $user_password = mysqli_real_escape_string($this->db->link,$user_password);
            $user_phone = mysqli_real_escape_string($this->db->link,$user_phone);
            $user_name = mysqli_real_escape_string($this->db->link,$user_name);
            $user_address = mysqli_real_escape_string($this->db->link,$user_address);
            if(empty($user_email) || empty($user_password) || empty($user_phone)|| empty($user_name)|| empty($user_address) ) {
                $alert = "<span class = 'error'>Not empty</span>";
                return $alert;
            }
            $check_email = "SELECT * FROM tbl_user WHERE user_email='$user_email' LIMIT 1 ";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class = 'error'>Email already existed</span>";
                return $alert;
            } else{
                $query = "INSERT INTO tbl_user(user_email,user_password,user_phone,user_name,user_address)
                 VALUES('$user_email','$user_password','$user_phone','$user_name','$user_address')";
                 $result = $this->db->insert($query);
                 if($result){
                    header('Location:login.php');
                 } else{
                    $alert = "<span class = 'error'>User created not successfully</span>";
                return $alert;
                 }
            }
        }
        public function insert_user_($user_email,$user_password,$user_phone,$user_name, $user_address){
            $user_email = mysqli_real_escape_string($this->db->link,$user_email);
            $user_password = mysqli_real_escape_string($this->db->link,$user_password);
            $user_phone = mysqli_real_escape_string($this->db->link,$user_phone);
            $user_name = mysqli_real_escape_string($this->db->link,$user_name);
            $user_address = mysqli_real_escape_string($this->db->link,$user_address);
            if(empty($user_email) || empty($user_password) || empty($user_phone)|| empty($user_name)|| empty($user_address) ) {
                $alert = "<span class = 'error'>Not empty</span>";
                return $alert;
            }
            $check_email = "SELECT * FROM tbl_user WHERE user_email='$user_email' LIMIT 1 ";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class = 'error'>Email already existed</span>";
                return $alert;
            } else{
                $query = "INSERT INTO tbl_user(user_email,user_password,user_phone,user_name,user_address)
                 VALUES('$user_email','$user_password','$user_phone','$user_name','$user_address')";
                 $result = $this->db->insert($query);
                 if($result){
                    $alert = "<span >User created successfully</span>";
                return $alert;
                 } else{
                    $alert = "<span class = 'error'>User created not successfully</span>";
                return $alert;
                 }
            }
        }
    }
?>