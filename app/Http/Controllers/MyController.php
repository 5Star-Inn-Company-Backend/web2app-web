<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyController extends Controller
{

    public function convert(Request $request){
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'url' => 'required|max:255',
            'plan' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
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

}
