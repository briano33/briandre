<?php 

$status='';

echo <<<__END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>
    <link  rel="stylesheet" href="trial.css?v=<?php echo time();?>">
</head>
<body>
    <form action="" method="">    
        <div class="display-form">
            <h4 class="fw-bold">Rent Machine</h4>
            <p>$status</p>
            <div class="input-styling">
                <input type="text" name="machinery-name"  class="form-control">
            </div>                
            <div class="input-styling">
                <div>
                    <label for="pick-up-date">pick-up date</label>
                    <input type="date" name="pick-up-date" id="pick-up-date" class="form-control">
                </div>
                <div>
                    <label for="return-date">return date</label>
                    <input type="date" name="return-date" id="return-date" class="form-control">
                </div>
            </div>
            <div class="input-styling">
                <div>
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" placeholder="John Mwele" class="form-control">
                </div>
                <div>
                    <label for="number">phone number</label>
                    <input type="text" name="phone-number" id="name" placeholder="254xxxxxxxxx" class="form-control">
                </div>
            </div>   
            <div class="input-styling">
                <div class="me-2">
                    <label for="amount">payment</label>
                    <input type="text" name="payment" class="form-control">
                </div>
                <div>
                    <label for="number">number to rent</label>
                    <input type="text" name="number-to-rent" class="form-control">
                </div>
            </div>
            <div class="button-styling rounded">
                <button type="submit" class="px-2 py-2 rounded" name="order-button">Submit</button>
            </div>
        </div>
    </form>
    <form action="" method="">
        <div class="login-styling">
        <h4 class="fw-bold">LogIn</h4>
            <div class="my-3">                    
                <input type="text" name="username" class="form-control" placeholder="username">
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="password">
            </div>
            <div class="my-3 login-button">
                <button type="submit" class="px-2 py-1 rounded">LOGIN</button>
            </div>
        </div>
    </form>
    <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
 
</body>
</html>
__END;

function rentMachine($connection){
    global $status;

    if(isset($_SESSION['order-button'])){
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


                            header("Location:services.php");
                            die();                       
            }                          
        }
    }                       
}
function checkifNumeric($variable){
    if(is_numeric($variable)){
        return "";
    }else{
        return "phone number should be  numeric";
    }
}
function checkLength($variable){
    if(strlen($variable)!=13){
        return "";
    }else{
        return "your phone number is either shorter or longer";
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
		return '';}
 }

 function checkPasswordLength($varName){
    if(strlen($varName)<8){
        return "Short password<br>";
    }else{
            return " ";
        }
}
function adminLogin($connection){
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