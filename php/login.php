<?php
session_start();

include('connect.php');


if(isset($_POST['username'])){

    $email=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM user where email='$email' AND password='$password'";

    $result=mysqli_query($connect,$query);

    if($result && mysqli_num_rows($result)>0){
         $returnedData=mysqli_fetch_assoc($result);
        
        if($returnedData['email']==$email && $returnedData['password']==$password){
            $_SESSION['password']=$returnedData['password'];
            $_SESSION['email']=$returnedData['email'];
        }
    }else{
            $status=array("You don't have an account");
             echo json_encode($status);
        }

}
