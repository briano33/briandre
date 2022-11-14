<?php
function rentMachine($connection){
    global $status;

    if(isset($_SESSION['order-button'])){
        echo $crew;
        if(empty($_POST['machinery-name']) || empty($_POST['pick-up-date']) || empty($_POST['return-date']) || empty($_POST['name']) || empty($_POST['phone-number']) || empty($_POST['payment']) || empty($_POST['number-to-rent'])){
            $status.="empty fields are not allowed<br>";
            $status.=checkLength($_POST['phone-number']);
            $status.=checkifNumeric($_POST['phone-number']);

        }else{
            $machineryName=$_POST['machinery-name'];    
            $pickUpDate=$_POST['pick-up-date'];
            $returnDate=$_POST['return-date'];
            $name=$_POST['name'];
            $phoneNumber=$_POST['phone-number'];
            $payment=$_POST['payment'];
            $rentedMachinery=$_POST['number-to-rent'];

            
            if(checkStringLength($status)===0){
                            $query="INSERT INTO requests (phonenumber,name,machineryname,machinerynumber,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                    '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$amount)";
                            mysqli_query($connection,$query);

                            $query1="UPDATE cars SET is_approved='0' WHERE carname='$car'"; 
                            mysqli_query($connection,$query1); 


                            header("Location:machinery.php");                       
            }                          
        }
    }                       
}
function login($connection){
    global $status;

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $email=$_POST['email'];
            $password=$_POST['password'];

            $status.=checkEmailValidity($email);
            $status.=checkpasswordValidation($password);
            $status.=checkPasswordLength($password);

                $query="SELECT * FROM users WHERE email='$email'";
                $result=mysqli_query($connection,$query);
    
                if($result && mysqli_num_rows($result)>0){
                    $returnedData=mysqli_fetch_assoc($result);
        
                    if($returnedData['email']==$email && $returnedData['password']==$password){
                        $_SESSION['password']=$returnedData['password'];
                        $_SESSION['email']=$returnedData['email'];

                        header("Location:adminpanel.php");
                    }else{
                        $status.="Wrong user input.Try again<br>";
                        
                    }
        
                }else{
                    $status.="You don't have an account<br>";
                    
                }
        }

}
function checkEmailValidity($email){
    $explodedEmail=explode("@",$email);
    $emailExtension=strtolower(end($explodedEmail));
    $extensionsArray=array("yahoo.com","gmail.com","outlook.com",);
    if(in_array($emailExtension,$extensionsArray)){
        return " ";
    }else{
        return "Email is not valid<br>";
    }
}

function checkpasswordValidation($variable){
    if( !preg_match("/[a-z]/", $variable)||
		!preg_match("/[A-Z]/", $variable)||
		!preg_match("/[0-9]/", $variable)||
        !preg_match("/[!@#$%&^*(){}?]/",$variable)){
		return 'password must contain numbers,symbols,uppercase and lowercase letters<br>';}
	else{
		return '';
    }
 }

 function checkPasswordLength($varName){
    if(strlen($varName)<8){
        return "Short password<br>";
    }else{
            return " ";
        }
}
function checkStringLength($string){
    $stringLength;
    if(preg_match("/[a-zA-Z]/",$string)){
            $stringLength=strlen($string);
            return $stringLength;
     }else{
            $stringLength=0;
            return $stringLength;
     }

}
