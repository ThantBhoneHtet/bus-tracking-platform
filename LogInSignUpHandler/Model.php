<?php

    function Find_Same_Name(object $pdo, string $UserName)
    {
        $query      = "SELECT Name FROM User WHERE Name=:name;";
        $find_name  = $pdo->prepare($query);
        $find_name -> bindparam(":name",$UserName);
        $find_name -> execute();

        $result = $find_name->fetch(PDO::FETCH_ASSOC);
        return $result;
    };


    function Find_Same_Mail(object $pdo, string $UserEmail)
    {
        $query      = "SELECT Mail From User Where Mail=:mail;";
        $find_mail  = $pdo->prepare($query);
        $find_mail -> bindparam(":mail",$UserEmail);
        $find_mail -> execute();

        $result = $find_mail->fetch(PDO::FETCH_ASSOC);
        return $result;
    };


    function Extract_User_Info(object $pdo, string $UserEmail)
    {
        $query             = "SELECT Name,Role,Password,Image FROM User WHERE Mail=:mail;";
        $extract_password  = $pdo->prepare($query);
        $extract_password -> bindparam(":mail",$UserEmail);
        $extract_password -> execute();

        $result = $extract_password->fetch(PDO::FETCH_ASSOC);
        return $result;
    };


    function Insert_User(object $pdo, string $UserName, string $UserEmail, string $UserPassword)
    {
        
        $query         = "INSERT INTO User(Name,Mail,Password) VALUES(:name,:mail,:password);";
        $insert_user   = $pdo->prepare($query);
        $HashPassword  = password_hash($UserPassword,PASSWORD_BCRYPT);
        $insert_user  -> bindparam(":name",$UserName);
        $insert_user  -> bindparam(":mail",$UserEmail);
        $insert_user  -> bindparam(":password",$HashPassword);

        $insert_user  -> execute();
    };

    
    function Insert_G_User(object $pdo, string $UserName, string $UserEmail, $Image)
    {
        
        $query         = "INSERT INTO User(Name,Mail,Image) VALUES(:name,:mail,:image);";
        $insert_user   = $pdo->prepare($query);
        $insert_user  -> bindparam(":name",$UserName);
        $insert_user  -> bindparam(":mail",$UserEmail);
        $insert_user  -> bindparam(":image",$Image);
    
        $insert_user  -> execute();
    };


    function Get_User_Id(object $pdo,String $UserName)
    {
        $query   = "SELECT Id from User WHERE Name = :name;";
        $get_id  = $pdo->prepare($query);
        $get_id -> bindparam(":name",$UserName);
        $get_id -> execute();
        
        $result = $get_id->fetch(PDO:: FETCH_ASSOC);
        return $result;
    };


    function Update_Password(object $pdo,string $mail,string $password)
    { 
        $query        =  "UPDATE User SET Password=:pswd WHERE Mail=:mail";
        $update       =  $pdo->prepare($query);
        $update       -> bindParam(":mail",$mail);
        $HashPassword = password_hash($password,PASSWORD_BCRYPT);
        $update       -> bindParam("pswd",$HashPassword);
    
        $update       -> execute();
    };




?>