   <?php
   if(isset($_POST['Body'])){
    $data=$_POST['Body'];
    stkSimulate($data);
}
   /**
     * receive and store stk callback data
     * 
     */
    function stkPush($data)
    {

        if ($data["stkCallback"]["ResultCode"] == 0) {
            $transaction_date = $data["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
            $merchant_request_id = $data["stkCallback"]["MerchantRequestID"];
            $checkout_request_id = $data["stkCallback"]["CheckoutRequestID"];
            $result_code = $data["stkCallback"]["ResultCode"];
            $result_description = $data["stkCallback"]["ResultDesc"];
            $amount = $data["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
            $mpesa_receipt_number = $data["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
            $phone_number = $data["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];
            $transaction_date = strval(date("Y-m-d H:i:s", strtotime($transaction_date)));
            //make query to store this transacion data into database here
        }
    }