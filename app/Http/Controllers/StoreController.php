<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\purchase;

class StoreController extends Controller
{
    public function addstore(Request $request)
    {
        $store = new Store();

        $store->name = $request->name;
        $store->price = $request->price;
        $store->description = $request->description;
        $store->feature = $request->feature;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('images/', $filename);
            $store->image = $filename;
        }

        $store->save();
        return redirect()->back()->with('status', 'Successfully Saved!');
    }

    public function showstore()
    {
        $store = Store::all();
        return view('showstore', compact('store'));
    }

    public function viewstore($id)
    {
        $store = Store::where('id', $id)->get();
        return view('viewstore', compact('store'));
    }

    //for purchase
    public function purchase(Request $request)
    {
        // dd($request->id);
        $purchase = new purchase();
        $store = Store::where('id', $request->id)->first();

        $purchase->name = $store->name;
        $purchase->email = $request->email;
        $purchase->price = $store->price;
        $purchase->reference_code = "prisca" . rand();
        $purchase->save();
     
// $purchase->refresh();

        $input = $request->all();

   
   
        $amount = $store->price;
    

   

        $reference = $purchase->reference_code;


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
            CURLOPT_POSTFIELDS => '{
    "amount": ' . $amount . ',
    "redirect_url": " ' . url("/viewstore" . '/' . $purchase->id) . ' ",
    "currency": "NGN",
    "reference": "' . $reference . '",
    "customer" : {
        "email" : " ' . $request->email . ' "
    }


}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_test_9YusxDq7qXi2sksYvQENTCCCQVDpoujZpRbVMbUG',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
//  dd($response);
        $ref = json_decode($response, true);
        if ($ref['status']) {
            return redirect()->away($ref["data"]["checkout_url"]);

        }

        
        return $input;

    
    }
}
