<?php

namespace App\Http\Controllers;

use App\Models\convert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyController extends Controller
{

    public function convert(Request $request){
$con = new convert;
$con->url = $request->url;
$con->plan = $request->plan;
// $con->plan1 = $request->plan1;
// $con->plan2 = $request->plan2;
// $con->plan3 = $request->plan3;
$con->appname = $request->appname;
$con->icon = $request->icon;
$con->fullscreen = $request->fullscreen;
$con->primarycolor = $request->primarycolor;
$con->packagename = $request->packagename;
$con->admob = $request->admob;
$con->admobID = $request->admobID;
$con->save();





        $input=$request->all();
// dd($input);
        $validator = Validator::make($request->all(), [
            'url' => 'required|max:255',
            'plan' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
if($input["plan"] == "gold"){
$amount = 150;
}elseif($input["plan"] == "premuim"){
$amount = 200;
}else{
$amount = 100;
}
$reference = "prisca_". rand();
        // <?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.korapay.com/merchant/api/v1/charges/initialize',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "amount": '.$amount.',
    "redirect_url": "https://web.postman.co/workspace/My-Workspace~342a36de-268d-43fd-8714-fbc242b7ea70/request/create?requestId=c4c5672f-f0d1-49d5-baf1-cc4c3008664f",
    "currency": "NGN",
    "reference": "'.$reference.'",
    "customer" : {
        "email" : "prisca@gmail.com"
    }


}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer sk_test_9YusxDq7qXi2sksYvQENTCCCQVDpoujZpRbVMbUG',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

echo $response;
// dd($response);
$ref = json_decode($response, true);
if($ref['status']){
    return redirect()->away($ref["data"]["checkout_url"]);
}

        return $input;



    }

    function encryptdata($plain, $aeskey, $ivkey){
        return bin2hex(openssl_encrypt($plain, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA, $ivkey));
    }

    function decryptdata($encriptedData, $aeskey, $ivkey){
        $ciphertext = hex2bin($encriptedData);
        return openssl_decrypt($ciphertext, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA, $ivkey);
    }

    public function  payform()
    {
     $response = Http::withToken('sk_test_1eb15cdd2c37d825fef6bdefb94ea2eecf921fd1')->get('https://api.paystack.co/bank');
    $data = $response->body();
    
    $json = json_decode($data);
    
    $banks= $json->data;
        return view('create', compact('banks'));
    }

    


}
