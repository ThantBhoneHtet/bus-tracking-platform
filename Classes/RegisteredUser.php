<?php
       require_once "./Database/DatabaseConnect.php";
    class Registered_User
    {
        private $User_Id;
        private $pdo;

        public function __construct($User_Id,object $pdo)
        {
            $this->User_Id = $User_Id;
            $this->pdo    = $pdo;
        }

        public function Save_route($route_data, $directory)
        {
            $date   =  date('Y-m-d');
            $query  =  "INSERT INTO saved_route(User_Id,Route,directory,Date) VALUES(:user_id,:route,:directory,:date)";
            $insert =  $this->pdo->prepare($query);
            $insert -> bindparam(":user_id",$this->User_Id);
            $insert -> bindparam(":route",$route_data);
            $insert -> bindparam(":date",$date);
            $insert -> bindparam(":directory",$directory);
            $insert -> execute();
        }

        public function Fetch_Save($dir)
        {
            $select = "SELECT * FROM Saved_Route WHERE directory = :dir";
            $stmt = $this->pdo->prepare($select);
            $stmt->bindParam(':dir', $dir, PDO::PARAM_STR);
            $stmt->execute();
            $saved_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $saved_data;
        }

        public function  delete_Save_route($routeid) 
        {
            $delete = "DELETE FROM Saved_Route WHERE route_id = $routeid";
            $this->pdo->query($delete);
        }

        public function save_feedback($feedback)
        {
            $query  =  "INSERT INTO feedback(user_id,description) VALUES(:user_id, :description)";
            $insert =  $this->pdo->prepare($query);
            $insert -> bindparam(":user_id",$this->User_Id);
            $insert -> bindparam(":description",$feedback);
            $insert -> execute();
        }
        
    }

    if(isset($_SESSION["user_id"]))
    {
        $u_id = $_SESSION["user_id"];
        $registered_user = new Registered_User($u_id,$pdo);
    };



?>