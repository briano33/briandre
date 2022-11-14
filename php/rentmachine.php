<?php 
session_start();

include('connect.php');
require_once "devcoder.php";

(new DotEnv(__DIR__ . '/.env'))->load();
  

if(isset($_POST['phoneNumber'])){
        $status='';
            
    $status.=validatePhoneNumber($_POST['phoneNumber']);
    $status.=checkifNumeric($_POST['numberOfMachines']);


           

        if(checkStringLength($status)===0){

            $machineryName=$_POST['machineName'];    
            $pickUpDate=$_POST['pickUpDate'];
            $returnDate=$_POST['returnDate'];
            $name=$_POST['userName'];
            $phoneNumber=$_POST['phoneNumber'];
            $payment=$_POST['amount'];
            $rentedMachinery=$_POST['numberOfMachines'];

            $pickUp=date_create($pickUpDate);
            $returnDay=date_create($returnDate);
            $timeDifference=date_diff($pickUp,$returnDay);
            $timeDifference=(int)$timeDifference->format("%a");

            if($machineryName==='Canola Machine'){
               
                $canolaQuery="SELECT charges FROM machines WHERE machinename='canola'";
                $canolaResult=mysqli_query($connect,$canolaQuery);
                

                if($canolaResult && mysqli_num_rows($canolaResult)>0){
                    foreach($canolaResult as $row){                       
                        $charges=$row['charges'];
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }


                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);
                }                
            }

            if($machineryName==='Combined Harvester'){
               
                $combineQuery="SELECT numberremaining,charges FROM machines WHERE 
                               machinename='combine_harvester'";
                $combineResult=mysqli_query($connect,$combineQuery);
                

                if($combineResult && mysqli_num_rows($combineResult)>0){
                   foreach($combineResult as $row){
                        $charges=$row['charges'];                        
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }

                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);
                    
                }                
            }

            if($machineryName==='Grain Dryer'){
               
                $dryerQuery="SELECT numberremaining,charges FROM machines WHERE machinename='graindrayer'";
                $dryerResult=mysqli_query($connect,$dryerQuery);
                

                if($dryerResult && mysqli_num_rows($dryerResult)>0){
                    foreach($dryerResult as $row){
                        $charges=$row['charges'];
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }

                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);
                   
                }                
            }

            if($machineryName==='Hay Baler'){
               
                $balerQuery="SELECT numberremaining,charges FROM machines WHERE machinename='hay_harvester'";
                $balerResult=mysqli_query($connect,$balerQuery);
                

                if($balerResult && mysqli_num_rows($balerResult)>0){
                    foreach($balerResult as $row){
                        $charges=$row['charges'];
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }
                                          
                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);
                }                
            }

            if($machineryName==='Maize Harvester'){
               
                $maizeQuery="SELECT numberremaining,charges FROM machines WHERE machinename='maize_harvester'";
                $maizeResult=mysqli_query($connect,$maizeQuery);
                

                if($maizeResult && mysqli_num_rows($maizeResult)>0){
                    foreach($maizeResult as $row){
                        $charges=$row['charges'];
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }

                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);    
                                   
                }                
            }

            if($machineryName==='Silage'){
               
                $silageQuery="SELECT numberremaining,charges FROM machines WHERE machinename='sailage'";
                $silageResult=mysqli_query($connect,$silageQuery);
                

                if($silageResult && mysqli_num_rows($silageResult)>0){
                    foreach($silageResult as $row){
                        $charges=$row['charges'];
                    }
    
                    if($timeDifference===0){
                        $payment=$charges * $rentedMachinery; 
                    }else{
                        $payment=$charges * $rentedMachinery * $timeDifference;
                    }

                        
                        $query="INSERT INTO requests (phonenumber,name,machinename,numbertohire,pickupdate,returndate,amount)VALUES('$phoneNumber',
                                            '$name','$machineryName','$rentedMachinery','$pickUpDate','$returnDate',$payment)";
                        mysqli_query($connect,$query);

                        stkSimulate($phoneNumber, $payment);                     
                }                
            }

                    
                        
        }else{
             echo json_encode($status);
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
function validatePhoneNumber($phoneNumber){
    if(strlen($phoneNumber)===12  && substr($phoneNumber,0,3)==='254' && is_numeric($phoneNumber)){
        return "";
    }else{
        return "Your phone number should start with 254 and be 12 digits long\n";
    }
}
function CheckIfNumeric($numberOfMachines){
   if(is_numeric($numberOfMachines)){
       return "";
   }else{
       return "Number of machines should be numeric";
   }
}
function getAccessToken()
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $ch = curl_init($url);
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_HTTPHEADER => [
                    'Authorization: Basic ' . base64_encode(getenv('MPESA_CONSUMER_KEY') . ':' . getenv('MPESA_CONSUMER_SECRET'))
                ],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false, 
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
        return $response['access_token'];
    }

    /**
     * simulate lipa na mpesa express
     */
    function stkSimulate($phone_number, $amount)
    {
        $response=stkPay($phone_number, $amount);
        return $response;
    }

    /**
     * receive lipa na mpesa express request data
     */
    function stkPay($phone_number, $amount)
    {
        $timestamp = date('YmdHis');
        $password = base64_encode(getenv('MPESA_STK_SHORTCODE') . getenv('MPESA_PASS_KEY') . $timestamp);

        $curl_post_data = array(
            'BusinessShortCode' =>getenv('MPESA_STK_SHORTCODE'),
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone_number,
            'PartyB' => getenv('MPESA_STK_SHORTCODE'),
            'PhoneNumber' => $phone_number,
            'CallBackURL' => getenv('MPESA_TEST_URL') . '/transactions.php',
            'AccountReference' => 'CompanyXLTD',
            'TransactionDesc' => 'Payment of X',
        );

        $url = '/stkpush/v1/processrequest';

        $response = makeHttp($url, $curl_post_data);
        return $response;
    }

    /**
     * compiles a daraja api request body and sends the request to the api
     * @param mixed $url
     * @param mixed $body
     */
    function makeHttp($url, $body)
    {
        // $url = 'https://mpesa-reflector.herokuapp.com' . $url;
        $url = 'https://sandbox.safaricom.co.ke/mpesa' . $url;
        $my_access_token = getAccessToken();
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $my_access_token,
                    'Content-Type: application/json'
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body)
            )
        );
        $curl_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($curl_response, true);
        return $response;
    }