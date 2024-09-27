<?php

namespace App\Http\Controllers;

use App\Models\convert;
use Illuminate\Http\Request;

class ConvertAppController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        convert::updateOrCreate([
            "url" => $request->url,
            "email" => $request->email
        ]);
    }
}
