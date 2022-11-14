<?php 

session_start();

include('connect.php');
include('functions.php');

 if(isset($_SESSION['email'])){

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
    <link rel="stylesheet" href="../css/dashboard.css?v=<?php echo time();?>">
    <title>Admin</title>
</head>
<body>
    <header class="sizing">
            <nav class="navbar navbar-expand-lg navbar-fixed py-2">
                <div class="container-fluid">
                    <a class="navbar-brand text-light" href="#"></a>
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"     
                     data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                      aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-lg-center align-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item list-style-none">
                                <a class="nav-link fw-bold" aria-current="page" href="index.php">home</a>
                            </li>
                            <li class="nav-item  list-style-none">
                                <a class="nav-link fw-bold" href="machinery.php">machinery</a>
                            </li>
                            <li class="nav-item  list-style-none">
                                <a class="nav-link fw-bold" href="about.php">about</a>
                            </li> 
                            <li class="nav-item  list-style-none">
                                <a class="nav-link fw-bold" href="logout.php">logout</a>
                            </li>                           
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    <div class="content" id="home">
        <section>
        <h3 class="text-center fw-bold text-light">ORDERS</h3>
        <h4 class=" text-center text-light">Pending</h4>
__END;

            $query1="SELECT * FROM requests WHERE approval='0' ORDER BY id DESC";
            $result1=mysqli_query($connect,$query1);

            if($result1 && mysqli_num_rows($result1)>0){
                $rows=mysqli_num_rows($result1);

echo <<<__END

            <table class="table table-sm table-light table-striped">
                <thead>
                    <tr class="text-center">
                        <th>machine name</th>
                        <th>number to hire</th>
                        <th>pick up date</th>
                        <th>pick up time</th>
                        <th>user name</th>                       
                        <th>phone Number</th>
                        <th>payment</th>
                        <th colspan="2" class-"text-center">decision</th>
                    </tr>
                </thead>
                <tbody>
__END;

                for($i=0;$i<$rows;$i++){
                    mysqli_data_seek($result1,$i);
                    $id=mysqli_fetch_assoc($result1)['id'];

                    mysqli_data_seek($result1,$i);
                    $phoneNumber=mysqli_fetch_assoc($result1)['phonenumber'];

                    mysqli_data_seek($result1,$i);
                    $userName=mysqli_fetch_assoc($result1)['name'];

                    mysqli_data_seek($result1,$i);
                    $machineName=mysqli_fetch_assoc($result1)['machinename'];

                    mysqli_data_seek($result1,$i);
                    $machineNumberToHire=mysqli_fetch_assoc($result1)['numbertohire'];   

                    mysqli_data_seek($result1,$i);
                    $pickUpDate=mysqli_fetch_assoc($result1)['pickupdate'];

                    mysqli_data_seek($result1,$i);
                    $returnDate=mysqli_fetch_assoc($result1)['returndate'];

                    mysqli_data_seek($result1,$i);
                    $amountPaid=mysqli_fetch_assoc($result1)['amount'];



echo <<<__END
            <tr class="text-center">
                <td>$machineName</td>
                <td>$machineNumberToHire</td>
                <td>$pickUpDate</td>
                <td>$returnDate</td>
                <td>$userName</td>
                <td>$phoneNumber</td>
                <td>$amountPaid</td>
                <td>
                    <div class="approve">
                        <form action="manage.php" method="POST">
                        <input type="hidden" name="id" value="$id">
                        <input type="hidden" name="approve" value="approve">
                        <input type="submit" value="Approve" name="approve" class="border-0 btn btn-outline-success fw-bold">
                        </form>
                    </div>
                </td>
                <td>
                    <div class="decline">
                        <form action="manage.php" method="POST">
                            <input type="hidden" name="id" value="$id">
                            <input type="hidden" name="decline" value="decline">
                            <input type="submit" value="Decline" name="decline" class="border-0 btn btn-outline-danger fw-bold">
                        </form>
                    </div>
                </td>
            </tr>
__END;
                }
echo <<<__END
       </tbody>
    </table>
__END;
            
         }else{
             echo "<p class='text-center text-light'>No Pending Orders</p>";
         }
                         

            echo "<h4 class='text-center text-light mt-2'>Approved</h4>";

            $query2="SELECT * FROM requests WHERE approval='1' ORDER BY id DESC";
            $result2=mysqli_query($connect,$query2);

            if($result2 && mysqli_num_rows($result2)>0){
                $rows=mysqli_num_rows($result2);

echo <<<__END

            <table class="table table-sm table-light table-striped">
                <thead>
                    <th>machine name</th>
                    <th>number to hire</th>
                    <th>pick up date</th>
                    <th>pick up time</th>
                    <th>user name</th>                       
                    <th>phone Number</th>
                    <th>payment</th>
                    <th>decision</th>
                </thead>
                <tbody>
__END;

              for($i=0;$i<$rows;$i++){
                    mysqli_data_seek($result2,$i);
                    $id=mysqli_fetch_assoc($result2)['id'];

                    mysqli_data_seek($result2,$i);
                    $phoneNumber=mysqli_fetch_assoc($result2)['phonenumber'];

                    mysqli_data_seek($result2,$i);
                    $userName=mysqli_fetch_assoc($result2)['name'];

                    mysqli_data_seek($result2,$i);
                    $machineName=mysqli_fetch_assoc($result2)['machinename'];

                    mysqli_data_seek($result2,$i);
                    $machineNumberToHire=mysqli_fetch_assoc($result2)['numbertohire'];   

                    mysqli_data_seek($result2,$i);
                    $pickUpDate=mysqli_fetch_assoc($result2)['pickupdate'];

                    mysqli_data_seek($result2,$i);
                    $returnDate=mysqli_fetch_assoc($result2)['returndate'];

                    mysqli_data_seek($result2,$i);
                    $amountPaid=mysqli_fetch_assoc($result2)['amount'];


                    

                    
echo <<<__END
            <tr class="text-center">
                <td>$machineName</td>
                <td>$machineNumberToHire</td>
                <td>$pickUpDate</td>
                <td>$returnDate</td>
                <td>$userName</td>
                <td>$phoneNumber</td>
                <td>$amountPaid</td>
                <td>
                    <div class="decline">
                        <form action="manage.php" method="POST">
                            <input type="hidden" name="id" value="$id">
                            <input type="hidden" name="Returned" value="Returned">
                            <input type="submit" value="Returned" name="Returned" class="border-0 btn btn-outline-info fw-bold">
                        </form>
                    </div>
                </td>
            </tr>
__END;
            }
echo "</tbody>
    </table>";
        }else{
            echo "<p class='text-center text-light'>No approved orders<p>";
        }


echo <<<__END
</section>
    </div> 
     <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>   
  </body>
</html>
__END;
  
 }else{
      echo "<p class='fw-bold'>Unauthorised Access</p>";

}
