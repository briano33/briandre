<?php
session_start();

include('connect.php');
include('functions.php');

$status="";
rentMachine($connect);

            $queryMachine1="SELECT * FROM machines WHERE machinename='canola'";
            $resultMachine1=mysqli_query($connect,$queryMachine1);
            if($resultMachine1 && mysqli_num_rows($resultMachine1)){
                foreach($resultMachine1 as $row){
                    $canola=$row['numberremaining'];
                    $canolaCharges=$row['charges'];
                }
                 if($canola<0){
                    $canola=0;
                }
               
            }
             
            $queryMachine2="SELECT * FROM machines WHERE machinename='combine_harvester'";
            $resultMachine2=mysqli_query($connect,$queryMachine2);
            if($resultMachine2 && mysqli_num_rows($resultMachine2)){
                foreach($resultMachine2 as $row){
                    $combineHarvester=$row['numberremaining'];
                    $combineHarvesterCharges=$row['charges'];
                }
               
            }
                if($combineHarvester<0){
                    $combineHarvester=0;
            }

            $queryMachine3="SELECT * FROM machines WHERE machinename='graindrayer'";
            $resultMachine3=mysqli_query($connect,$queryMachine3);
            if($resultMachine3 && mysqli_num_rows($resultMachine3)){
                foreach($resultMachine3 as $row){
                    $grainDrayer=$row['numberremaining'];
                    $grainDrayerCharges=$row['charges'];
                }               
            }
            if($grainDrayer<0){
                $grainDrayer=0;
            }

            $queryMachine4="SELECT * FROM machines WHERE machinename='hay_harvester'";
            $resultMachine4=mysqli_query($connect,$queryMachine4);
            if($resultMachine4 && mysqli_num_rows($resultMachine4)){
                foreach($resultMachine4 as $row){
                    $hayHarvester=$row['numberremaining'];
                    $hayHarvesterCharges=$row['charges'];
                }                
            }
            if($hayHarvester<0){
                $hayHarvester=0;
            }

            $queryMachine5="SELECT * FROM machines WHERE machinename='maize_harvester'";
            $resultMachine5=mysqli_query($connect,$queryMachine5);
            if($resultMachine5 && mysqli_num_rows($resultMachine5)){
                foreach($resultMachine5 as $row){
                    $maizeHarvester=$row['numberremaining'];
                    $maizeHarvesterCharges=$row['charges'];
                }               
                    if($maizeHarvester<0){
                        $maizeHarvester=0;
                    }
            }
            $queryMachine6="SELECT * FROM machines WHERE machinename='sailage'";
            $resultMachine6=mysqli_query($connect,$queryMachine6);
            if($resultMachine6 && mysqli_num_rows($resultMachine6)){
                foreach($resultMachine6 as $row){
                    $sailage=$row['numberremaining'];
                    $sailageCharges=$row['charges'];
                }
                
                if($sailage<0){
                    $sailage=0;
                }
            }
             
echo <<<__END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/machinery.css?v=<?php echo time();?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login').on("click", function(e){
                e.preventDefault();
                let username=$('#email').val();
                let password=$('#password').val();

                    if(username != '' && password != ''){
                        $.ajax({
                            url: "login.php",
                            method: "POST",
                            data:
                            {username: username, password: password},
                            success: function(response){
                                
                               if(response){
                                   $('#login_msg').text("Wrong email or password");
                                }else{
                                    window.location.href="dashboard.php";
                                }
                            }
                            });
                    }else{
                        $('#login_msg').text("Both fields are required");
                    }
            })
        });
        $(document).ready(function(){
        $('#canola-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#canola-input-name').val();
                let pickUpDate=$('#canola-pick-up-date').val();
                let returnDate=$('#canola-return-date').val();
                let userName=$('#canola-username').val();
                let phoneNumber=$('#canola-phone-number').val();
                let amount=$('#canola-input-amount').val();
                let numberOfMachines=$('#canola-input-number').val();
            
                    if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#canola_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#canola_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#canola_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#canola_msg').text("All fields are required");
                    }
            });

        });
        
        $(document).ready(function(){
        $('#combine-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#combine-input-name').val();
                let pickUpDate=$('#combine-pick-up-date').val();
                let returnDate=$('#combine-return-date').val();
                let userName=$('#combine-username').val();
                let phoneNumber=$('#combine-phone-number').val();
                let amount=$('#combine-input-amount').val();
                let numberOfMachines=$('#combine-input-number').val();
            
                   if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#combine_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#combine_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#combine_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#combine_msg').text("All fields are required");
                    }
                        
            });

        });
         $(document).ready(function(){
        $('#dryer-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#dryer-input-name').val();
                let pickUpDate=$('#dryer-pick-up-date').val();
                let returnDate=$('#dryer-return-date').val();
                let userName=$('#dryer-username').val();
                let phoneNumber=$('#dryer-phone-number').val();
                let amount=$('#dryer-input-amount').val();
                let numberOfMachines=$('#dryer-input-number').val();
            
                    if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#dryer_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#dryer_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#dryer_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#dryer_msg').text("All fields are required");
                    }
            });

        });
            $(document).ready(function(){
            $('#hay-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#hay-input-name').val();
                let pickUpDate=$('#hay-pick-up-date').val();
                let returnDate=$('#hay-return-date').val();
                let userName=$('#hay-username').val();
                let phoneNumber=$('#hay-phone-number').val();
                let amount=$('#hay-input-amount').val();
                let numberOfMachines=$('#hay-input-number').val();
            
                    if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#hay_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#hay_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#hay_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#hay_msg').text("All fields are required");
                    }
            });

        });
        $(document).ready(function(){
            $('#maize-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#maize-input-name').val();
                let pickUpDate=$('#maize-pick-up-date').val();
                let returnDate=$('#maize-return-date').val();
                let userName=$('#maize-username').val();
                let phoneNumber=$('#maize-phone-number').val();
                let amount=$('#maize-input-amount').val();
                let numberOfMachines=$('#maize-input-number').val();
            
                    if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#maize_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#maize_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#maize_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#maize_msg').text("All fields are required");
                    }
            });

        });
        $(document).ready(function(){
            $('#silage-submit-btn').on("click", function(e){

                e.preventDefault();
                let machineName=$('#silage-input-name').val();
                let pickUpDate=$('#silage-pick-up-date').val();
                let returnDate=$('#silage-return-date').val();
                let userName=$('#silage-username').val();
                let phoneNumber=$('#silage-phone-number').val();
                let amount=$('#silage-input-amount').val();
                let numberOfMachines=$('#silage-input-number').val();
            
                   if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberOfMachines !=''){

                        let time=new Date()
                        let year=time.getFullYear()
                        let month=time.getMonth()+1
                        let date=time.getDate()
                        let fullDate=year+"-"+month+"-"+date
            
                        let pickDay=pickUpDate
                        let returnDay=returnDate
                        
                        if(new Date(pickDay) >= new Date(fullDate)){
                            
                            if(new Date(returnDay) >= new Date(pickDay)){
                                $.ajax({
                                    url: "rentmachine.php",
                                    method: "POST",
                                    data:
                                    {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                                    success: function(response){                               
                                    if(response){
                                        $('#silage_msg').text(response);
                                        }else{
                                        
                                            window.location.href="machinery.php";
                                        }
                                    }
                                    });
                            }else{
                                $('#silage_msg').text("return date has to be the same date as pick up date or a date later");    
                            }
                        }else{
                            $('#silage_msg').text("pick up date has to be the currect date or a date later"); 
                        }
                    }else{
                        $('#silage_msg').text("All fields are required");
                    }
            });

        });
    </script>
    <title>machinery</title>
</head>
<body>
    <div class="navigarion-wrapper">
        <article class="mb-0">
                <section id="navigation" class="mt-0">
                    <nav class="navbar navbar-expand-lg navbar-fixed py-2 mb-2">
                            <div class="container-fluid">
                                <a class="navbar-brand text-light" href="#"></a>
                                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"     
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-center align-center" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item list-style-none">
                                            <a class="nav-link fw-bold" aria-current="page" href="index.php">home</a>
                                        </li>
                                        <li class="nav-item  list-style-none">
                                            <a class="nav-link fw-bold" href="machinery.php">machinery</a>
                                        </li>
__END;
if(!isset($_SESSION['email'])){
    echo    "<li class='nav-item  list-style-none'>
                <a class='nav-link fw-bold' href='#'  data-bs-toggle='modal' data-bs-target='#admin'>
                    admin
                </a>
            </li>";
}else{
    echo    "<li class='nav-item  list-style-none'>
                <a class='nav-link fw-bold' href='dashboard.php'>admin</a>
            </li>";
}
echo <<<__END
                                <li class="nav-item  list-style-none">
                                    <a class="nav-link fw-bold" href="about.php">about</a>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                </nav>
        </section>
                                        <!-- Modal -->
                            <div class="modal fade" id="admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center fw-bolder mb-2 text-light">Admin</h4>
                                    <p id="login_msg" class="text-center text-danger fw-bold"></p>
                                    <form>
                                        <input type="text" name="email" placeholder="email" id="email" autocomplete="off" class="form-control d-block w-50 mx-auto mb-2 text-center border-0 outline-0">

                                        <input type="password" name="password" placeholder="Password" id="password" autocomplete="off" class="form-control d-block mx-auto mb-3 w-50 text-center border-0 outline-0">

                                        <div class="login">  
                                            <button type="submit" class="d-block py-1 px-2 rounded-pill w-25 mx-auto border-0 outline-0 fw-bold bg-light text-dark" id='login' name="login-btn">LOGIN</button>
                                        </div>                                    
                                    </form>
                                </div>  
                                </div>
                            </div>
                            </div>  
            </article>
        <div class="machines-intro">
        </div>
    </div>
    <div class="content-wrapper pt-5">  
    <div class="content mt-0">
        <section id="machinery">  
            <div class="services">
                <div class="details">
                    <div class="img">
                        <img src="../images/canola.jpg"  alt="image">
                    </div>
                    <div class=" details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold""><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="canola-name">Canola Machine</span></p>
                            <p class="mb-1 fw-bold"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oil extraction.</p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$canola</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="canola-amount">$canolaCharges</i></span> &nbsp;Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#canola" id="canola-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="canola" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="canola_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="canola_msg_success" class="text-center text-success fw-bold"></p>
                                        <form>    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="canola-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="canola-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="canola-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="canola-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" placeholder="254xxxxxxxxx" id="canola-phone-number" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="canola-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="canola-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="canola-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>
            <div class="services">
                <div class="details">
                    <div class="img">
                        <img src="../images/combineharvester2.jpg"  alt="image">
                    </div>
                    <div class="details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold"><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="combine-name">Combined Harvester</span></p>
                            <p class="mb-1 fw-bold text-wrap"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-center">Harvest grain crops.</span></p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$combineHarvester</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="combine-amount">$combineHarvesterCharges</i></span> &nbsp;Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#combine" id="combine-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="combine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="combine_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="combine_msg_success" class="text-center text-success fw-bold"></p>
                                        <form action="machinery.php" method="POST">    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="combine-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="combine-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="combine-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="combine-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" id="combine-phone-number" placeholder="254xxxxxxxxx" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="combine-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="combine-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="combine-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>
            <div class="services">
                <div class="details">
                    <div class="img">
                        <img src="../images/graindryer2.jpg" alt="image">
                    </div>
                    <div class="details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold"><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="dryer-name">Grain Dryer</span></p>
                            <p class="mb-1 fw-bold"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dry grains to the required need.</p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$grainDrayer</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="dryer-amount">$grainDrayerCharges</i></span> Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#dryer" id="dryer-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="dryer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="dryer_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="dryer_msg_success" class="text-center text-success fw-bold"></p>
                                        <form>    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="dryer-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="dryer-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="dryer-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="dryer-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" id="dryer-phone-number" placeholder="254xxxxxxxxx" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="dryer-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="dryer-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="dryer-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>
            <div class="services">
                <div class="details">
                    <div class="img">
                        <img src="../images/hay.jpg"  alt="image">
                    </div>
                    <div class="details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold"><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="hay-name">Hay Baler</span></p>
                            <p class="mb-1 fw-bold"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Compress and cut hay into bales</p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$hayHarvester</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="hay-amount">$hayHarvesterCharges</i></span> &nbsp;Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#hay" id="hay-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="hay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="hay_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="hay_msg_success" class="text-center text-success fw-bold"></p>
                                        <form action="" method="">    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="hay-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="hay-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="hay-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="hay-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" id="hay-phone-number" placeholder="254xxxxxxxxx" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="hay-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="hay-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="hay-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>
            <div class="services">
                <div class="details">
                    <div class="img">
                        <img src="../images/maizeharvester2.jpg" alt="image">
                    </div>
                    <div class="details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold"><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="maize-name">Maize Harvester</span></p>
                            <p class="mb-1 fw-bold"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harvest maize/corn.</p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$maizeHarvester</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="maize-amount">$maizeHarvesterCharges</i></span> &nbsp;Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#maize" id="maize-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="maize" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="maize_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="maize_msg_success" class="text-center text-success fw-bold"></p>
                                        <form>    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="maize-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="maize-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="maize-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="maize-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" id="maize-phone-number" placeholder="254xxxxxxxxx" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="maize-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="maize-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="maize-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>
            <div class="services mb-1">
                <div class="details">
                    <div class="img">
                        <img src="../images/silage2.jpg" alt="image">
                    </div>
                    <div class="details-text">
                        <div class="text-styling">
                            <p class="mb-1 fw-bold"><span>name:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="silage-name">Silage</span></p>
                            <p class="mb-1 fw-bold"><span>use:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grid and chop dry matters.</p>
                            <p class="mb-1 fw-bold"><span>remaining:</span>&nbsp;$sailage</p>                        
                        </div>                   
                        <div class="rent-btn">  
                                <p class="fw-bold"><span>charges:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h5"> Ksh.<i id="silage-amount">$sailageCharges</i></span> &nbsp;Daily</p> 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#silage" id="silage-btn" class="btn btn-success py-1 px-2">Hire Now</button>
                        </div>                         
                    </div>                   
                </div>
            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="silage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="silage_msg" class="text-center text-danger fw-bold"></p>
                                        <p id="silage_msg_success" class="text-center text-success fw-bold"></p>
                                        <form>    
                                            <div class="display-form">
                                                <h4 class="fw-bold">Rent Machine</h4>
                                                <p>$status</p>
                                                <div class="input-styling">
                                                    <input type="text" name="machinery-name"  class="form-control" id="silage-input-name" readonly>
                                                </div>                
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="pick-up-date">pick-up date</label>
                                                        <input type="date" name="pick-up-date" id="silage-pick-up-date" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="return-date">return date</label>
                                                        <input type="date" name="return-date" id="silage-return-date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-styling">
                                                    <div>
                                                        <label for="name">name</label>
                                                        <input type="text" name="name" id="silage-username" placeholder="John Mwele" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="number">phone number</label>
                                                        <input type="text" name="phone-number" id="silage-phone-number" placeholder="254xxxxxxxxx" class="form-control">
                                                    </div>
                                                </div>   
                                                <div class="input-styling">
                                                    <div class="me-2">
                                                        <label for="amount">amount to pay</label>
                                                        <input type="text" name="payment" class="form-control" id="silage-input-amount" readonly>
                                                    </div>
                                                    <div>
                                                        <label for="number">number to rent</label>
                                                        <input type="text" name="number-to-rent" class="form-control" id="silage-input-number">
                                                    </div>
                                                </div>
                                                <div class="button-styling rounded">
                                                    <button type="button" class="order-btn px-2 py-2 rounded" name="order-button" id="silage-submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>                        
                            </div>
                        </div>        
    </section>
    <footer class="sizing pt-2">
            <h3 class="text-center mt-3 text-light">Get In Touch</h3>
            <div class="contact-platforms">
                <div class="footer-align">
                    <h1><i class="bi bi-compass"></i></h1>
                    <h5>ADDRESS</h5>
                    <small>Location</small>
                    <small>Gachororo,Juja</small>
                    <small>Location</small>
                    <small>CLB,Nairobi</small>                   
                </div>
                <div class="footer-align">
                    <h1><i class="bi bi-telephone"></i></h1>
                    <h5>PHONE</h5>
                    <small>Safaricom</small>
                    <small>+254712345678</small>
                    <small>Airtel</small>
                    <small>+254786480157</small>                   
                </div>         
                <div class="footer-align">
                    <h1><i class="bi bi-envelope-open"></i></h1>
                    <h5>EMAIL</h5>
                    <small>theharvestors@gmail.com</small>
                    <small>harvestors001@gmail.com</small>                  
                </div>                       
            </div>
            <p class="text-light text-center fw-bold mb-4 mt-3">Copyright&copy;2022|All Rights Reserved|Project
            </p>
    </footer>    
  </div>
</div>
  <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <script>
            const canolaBtn=document.getElementById('canola-btn')
            const canolaName=document.getElementById('canola-name')
            const canolaAmount=document.getElementById('canola-amount')
            const canolaInputName=document.getElementById('canola-input-name')
            const canolaInputAmount=document.getElementById('canola-input-amount')
            const canolaInputNumber=document.getElementById('canola-input-number')

            canolaBtn.addEventListener('click',()=>{
                canolaInputName.value=canolaName.textContent;
            })

            canolaInputNumber.addEventListener('blur',()=>{
                canolaInputAmount.value=Number(canolaInputNumber.value)*Number(canolaAmount.textContent)
            
            })
                            // Combine Harvester 
            const combineBtn=document.getElementById('combine-btn')
            const combineName=document.getElementById('combine-name')
            const combineAmount=document.getElementById('combine-amount')
            const combineInputName=document.getElementById('combine-input-name')
            const combineInputAmount=document.getElementById('combine-input-amount')
            const combineInputNumber=document.getElementById('combine-input-number')

            combineBtn.addEventListener('click',()=>{
                combineInputName.value=combineName.textContent;
                
            })
            combineInputNumber.addEventListener('blur',()=>{
                combineInputAmount.value=Number(combineInputNumber.value)*Number(combineAmount.textContent)
            })

                        // GRAIN DRIER
            const dryerBtn=document.getElementById('dryer-btn')
            const dryerName=document.getElementById('dryer-name')
            const dryerAmount=document.getElementById('dryer-amount')
            const dryerInputName=document.getElementById('dryer-input-name')
            const dryerInputAmount=document.getElementById('dryer-input-amount')
            const dryerInputNumber=document.getElementById('dryer-input-number')

            dryerBtn.addEventListener('click',()=>{
                dryerInputName.value=dryerName.textContent;
            })
            dryerInputNumber.addEventListener('blur',()=>{
                dryerInputAmount.value=Number(dryerInputNumber.value)*Number(dryerAmount.textContent)
            })

                    // Hay Harvester
            const hayBtn=document.getElementById('hay-btn')
            const hayName=document.getElementById('hay-name')
            const hayAmount=document.getElementById('hay-amount')
            const hayInputName=document.getElementById('hay-input-name')
            const hayInputAmount=document.getElementById('hay-input-amount')
            const hayInputNumber=document.getElementById('hay-input-number')

            hayBtn.addEventListener('click',()=>{
                hayInputName.value=hayName.textContent;
            })

            hayInputNumber.addEventListener('blur',()=>{
                hayInputAmount.value=Number(hayInputNumber.value)*Number(hayAmount.textContent)
            })

                    // Maize Harvester
            const maizeBtn=document.getElementById('maize-btn')
            const maizeName=document.getElementById('maize-name')
            const maizeAmount=document.getElementById('maize-amount')
            const maizeInputName=document.getElementById('maize-input-name')
            const maizeInputAmount=document.getElementById('maize-input-amount')
            const maizeInputNumber=document.getElementById('maize-input-number')

            maizeBtn.addEventListener('click',()=>{
                maizeInputName.value=maizeName.textContent;
                
            })

            maizeInputNumber.addEventListener('blur',()=>{
                maizeInputAmount.value=Number(maizeInputNumber.value)*Number(maizeAmount.textContent)
            })


                    // Silage
            const silageBtn=document.getElementById('silage-btn')
            const silageName=document.getElementById('silage-name')
            const silageAmount=document.getElementById('silage-amount')
            const silageInputName=document.getElementById('silage-input-name')
            const silageInputAmount=document.getElementById('silage-input-amount')
            const silageInputNumber=document.getElementById('silage-input-number')

            silageBtn.addEventListener('click',()=>{
                silageInputName.value=silageName.textContent;
            })

            silageInputNumber.addEventListener('blur',()=>{
                silageInputAmount.value=Number(silageInputNumber.value)*Number(silageAmount.textContent)
            })



        </script>
</body>
</html>
__END;
