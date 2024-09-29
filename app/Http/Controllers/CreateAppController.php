<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppResource;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateAppController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    { 
        $this->validate($request, [
            'name' => ["required", "string"],
            'url' => ["required", "string"]
        ]);


        $user = Auth::user();

        $app = App::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->input('name'),
                'url' => $request->input('url'),
                'role_id' => $user->role_id,
            ]
        );


        return new AppResource($app);
    }
}
