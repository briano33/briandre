<?php
require_once "devcoder.php";

(new DotEnv(__DIR__ . '/.env'))->load();


if(isset($_POST['phone_number']) && isset($_POST['amount'])){
    $phone_number=$_POST['phone_number'];
    $amount=$_POST['amount'];
    $response=stkSimulate($phone_number, $amount);
    $response = json_encode($response);

}
    /**
     * get mpesa api access token
     * 
     */
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

// stkSimulate(254706441035, 1);