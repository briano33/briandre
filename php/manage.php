<?php
session_start();

include("connect.php");
include("functions.php");

$id=$_POST['id'];


    if(isset($_POST['approve'])){
                      
        $query1="SELECT machinename,numbertohire FROM requests WHERE id='$id'"; 
        $result=mysqli_query($connect,$query1);

        if($result && mysqli_num_rows($result)>0){
                foreach($result as $row){
                        $machineName=$row['machinename'];
                        $numbertohire=$row['numbertohire'];
                }
                if($machineName==='Canola Machine'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='canola'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='canola'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Combine Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='combine_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='combine_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Grain Dryer'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='graindrayer'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='graindrayer'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Hay Baler'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='hay_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='hay_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Maize Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='maize_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='maize_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Silage'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='sailage'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber - (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='sailage'";
                        mysqli_query($connect,$query3);
                }
        }
            $queryApprove="UPDATE requests SET approval='1' WHERE id='$id'";
            mysqli_query($connect,$queryApprove);

            header("Location:dashboard.php");

    }

    if(isset($_POST['decline'])){

        $query1="SELECT machinename,numbertohire FROM requests WHERE id='$id'"; 
        $result=mysqli_query($connect,$query1);

        if($result && mysqli_num_rows($result)>0){
                foreach($result as $row){
                        $machineName=$row['machinename'];
                        $numbertohire=$row['numbertohire'];
                }
                if($machineName==='Canola Machine'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='canola'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='canola'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Combine Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='combine_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='combine_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Grain Dryer'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='graindrayer'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='graindrayer'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Hay Baler'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='hay_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='hay_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Maize Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='maize_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='maize_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Silage'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='sailage'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='sailage'";
                        mysqli_query($connect,$query3);
                }
        }
        $queryDelete="DELETE FROM requests WHERE id='$id'";
        mysqli_query($connect,$queryDelete);
        header("Location:dashboard.php");
    }

    if(isset($_POST['Returned'])){
        $query1="SELECT machinename,numbertohire FROM requests WHERE id='$id'"; 
        $result=mysqli_query($connect,$query1);

        if($result && mysqli_num_rows($result)>0){
                foreach($result as $row){
                        $machineName=$row['machinename'];
                        $numbertohire=$row['numbertohire'];
                }
                if($machineName==='Canola Machine'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='canola'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='canola'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Combine Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='combine_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='combine_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Grain Dryer'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='graindrayer'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='graindrayer'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Hay Baler'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='hay_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='hay_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Maize Harvester'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='maize_harvester'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='maize_harvester'";
                        mysqli_query($connect,$query3);
                }
                if($machineName==='Silage'){
                        
                        $query2="SELECT numberremaining From machines WHERE machinename='sailage'";
                        $result2=mysqli_query($connect,$query2);

                        if($result2 && mysqli_num_rows($result2)>0){
                                $databaseNumber=mysqli_fetch_assoc($result2)['numberremaining'];
                        }

                        $databaseNumber=(int)$databaseNumber + (int)$numbertohire;
                        $query3="UPDATE machines SET numberremaining='$databaseNumber' WHERE 
                                 machinename='sailage'";
                        mysqli_query($connect,$query3);
                }
        }
            $queryReturn="DELETE FROM requests WHERE id='$id'";
            mysqli_query($connect,$queryReturn);
            header("Location:dashboard.php");
    }