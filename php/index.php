<?php
session_start();

include('connect.php');
include('functions.php');

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
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time();?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>home</title>
    <script>
        $(document).ready(function(){
            $('#login').on("click", function(e){
                e.preventDefault();
                var username=$('#email').val();
                var password=$('#password').val();

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
        })
    </script>
</head>
<body>
    <div class="content rounded">
        <div class="index-info">
            <article class="navigation">
                <section id="navigation" class="mt-0">
                    <nav class="navbar navbar-expand-lg navbar-fixed">
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
            echo     "<li class='nav-item  list-style-none'>
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
                                            <button type="submit" class="d-block py-1 px-2 rounded-pill w-25 mx-auto border-0 outline-0 fw-bold bg-light text-dark" id='login'>LOGIN</button>
                                        </div>                                    
                                    </form>
                                </div>  
                                </div>
                            </div>
                            </div>  
            </article>
            <div class="index-information">
                <h2 class="ms-2">Specializing in Agricultural activities.</h2>
                <article class="more-info">
                    <p>This site offers equipment for rental to use during the harvesting season.</p>
                    <div class="pb-3">
                        <button type="button" class="btn btn-success" id="show-btn">See More</button>
                    </div>
                </article>
            </div>
        </div>
        <div class="index-details">        
            <div class="index-image rounded">
                <img src="../images/combine_harvester.jpg" alt="image">
            </div>
        </div>
        <footer class="pt-3">
            <h3 class="text-center mt-3">Get In Touch</h3>
            <div class='contact-platforms'>
                <div class='more-info'>
                    <h2 class='text-center'><i class='bi bi-geo-alt'></i></h2>
                    <p class='fw-bolder'>TUK-Nairobi</p>
                    <p class='fw-bolder'>Vegas-Nakuru</p>
                </div>
                <div class='more-info'>
                    <h2 class='text-center'><i class='bi bi-door-closed'></i></h2>
                    <p class='fw-bolder'>Mon-Sat:8:00AM-5:00PM</p>
                    <p class='fw-bolder text-center'>Sun:Closed</p>
                </div>
                <div class='more-info'>
                    <h2 class='text-center'><i class='bi bi-telephone-inbound'></i></h2>
                    <p class='fw-bolder'>+254703193483</p>
                    <p class='fw-bolder'>+254706441031</p>
                </div>
                <div class='more-info'>
                    <h2 class='text-center'><i class='bi bi-envelope'></i></h2>
                    <p class='fw-bolder'><a href='apelles@gmail.com'>apelles@gmail.com</a></p>
                    <p class='fw-bolder'><a href='apelles@gmail.com'>apelles@gmail.com</a></p>
                </div>                        
            </div>
            <p class='text-center fw-bold mb-3'>Copyright&copy;2022|Project</p>
        </footer>
    </div>   
  <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <script>
            const showBtn=document.getElementById('show-btn');
            showBtn.addEventListener('click',()=>{
                location.href='machinery.php';
            })
        </script>
 
</body>
</html>
__END;