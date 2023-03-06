<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\convert;
use App\Models\feedback;
use App\Jobs\StartBuildJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyController extends Controller
{

    public function convert(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'url' => 'required|max:255',
            'plan' => 'required',
            'appname' => 'required',
            'firebase' => 'nullable|mimes:json',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if(strtolower($request->plan) == 'free'){
            $firebase=env('DEFAULT_PUSH_NOTIFICATION');
        }else{
            if(isset($input['firebase'])) {
                $firebase = file_get_contents($input['firebase']);
            }else {
                $firebase = env('DEFAULT_PUSH_NOTIFICATION');
            }
        }


        $con = new convert;
        $con->url = $request->url;
        $con->email = $request->email;
        $con->plan = $request->plan;
        $con->appname = $request->appname;
        $con->icon = $request->icon ?? 'https://web2app.5starcompany.com.ng/images/w2a.jpg';
        $con->fullscreen = $request->fullscreen;
        $con->primarycolor = $request->primarycolor;
        $con->packagename = $request->packagename ?? 'com.web2app';
        $con->admob = $request->admob ?? '';
        $con->admobID = $request->admobID ?? ' ';
        $con->publish = $request->publish ?? 'no';
        $con->tabLinks = json_encode($request->tabLink);
        $con->tabNames = json_encode($request->tabName);
        $con->tabIcons = json_encode($request->tabIcon);
        $con->status = '0';
        $con->uriPrefix = $request->uriPrefix ?? '';
        $con->linkPrefix = $request->linkPrefix ?? '';
        $con->firebase = $firebase;
        $con->reference_code = "web2app_" . uniqid() . rand();
        $con->save();

        $reference = $con->reference_code;

        if ($input["plan"] == "basic") {
            $amount = 5000;
        } elseif ($input["plan"] == "gold") {
            $amount = 10000;
        } elseif ($input["plan"] == "premium") {
            $amount = 20000;
        } else {
            $amount = 0;

            $con->status = 1;
            $con->save();

            StartBuildJob::dispatch($reference);

            return view('successpage', ['reference' => $reference]);
        }

        try {
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
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => '{
    "amount": ' . $amount . ',
    "redirect_url": " ' . route('successpage', $con->id) . ' ",
    "currency": "NGN",
    "reference": "' . $reference . '",
    "narration": "Payment on ' . $request->appname . ', for Web2App ' . $request->plan . ' plan",
    "customer" : {
        "email" : " ' . $request->email . ' "
    }
}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . env('KORAPAY_KEY'),
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $ref = json_decode($response, true);

            if ($ref['status']) {
                return redirect()->away($ref["data"]["checkout_url"]);
            } else {
                return back()->with('status', 'Error while processing payment');
            }
        } catch (\Exception$e) {
            return back()->with('status', 'Fatai error while processing payment');
        }

    }

    public function encryptdata($plain, $aeskey, $ivkey)
    {
        return bin2hex(openssl_encrypt($plain, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA, $ivkey));
    }

    public function decryptdata($encriptedData, $aeskey, $ivkey)
    {
        $ciphertext = hex2bin($encriptedData);
        return openssl_decrypt($ciphertext, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA, $ivkey);
    }

    public function payform()
    {
        $response = Http::withToken('sk_test_1eb15cdd2c37d825fef6bdefb94ea2eecf921fd1')->get('https://api.paystack.co/bank');
        $data = $response->body();

        $json = json_decode($data);

        $banks = $json->data;
        return view('create', compact('banks'));
    }

//for success page

    public function success($id, Request $request)
    {
        $input = $request->all();
        if (!isset($input['reference'])) {
            return redirect()->route('welcome');
        }

        $convert = convert::where([['id', $id], ['reference_code', $input['reference']]])->first();

        if (!$convert) {
            return redirect()->route('welcome');
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.korapay.com/merchant/api/v1/charges/' . $input['reference'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYPEER => false,

                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . env('KORAPAY_KEY'),
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $ref = json_decode($response, true);

            if ($ref['status']) {
                if ($ref['data']['status'] != "success") {
                    return redirect()->route('convert')->with('status', 'Payment not successful');
                }
            } else {
                return redirect()->route('convert')->with('status', 'Payment not found');
            }
        } catch (\Exception$e) {
            return redirect()->route('convert')->with('status', 'Fatai error while processing payment');
        }

        if ($convert->status == 0) {
            $convert->status = 1;
            $convert->save();

            StartBuildJob::dispatch($input['reference']);
        }

        return view('successpage', ['reference' => $input['reference']]);
    }

    public function feedback(Request $request)
    {
        $feed = new feedback();
        $feed->feedback = $request->feedback;
        $feed->save();
        if ($feed->save()) {
            return redirect()->back()->with('status', 'Thank you for your Feedback');
        }
    }

    public function update(Request $request)
    {

        //validation
        $val = $request->validate([
            // 'email' => 'required',
            'old_pass' => 'required',
            'new_pass' => 'required|min:8',
            'confirm_pass' => 'same:new_pass',
        ]);
//march password

        if (!Hash::check($request->old_pass, Auth::user()->password)) {
            return redirect()->back()->with("error","Old password dosent match");
        }

        //update password
        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->new_pass),
        ]);
        return redirect()->back()->with("status","Password Updated!");


    }
}
