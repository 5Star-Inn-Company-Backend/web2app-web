<?php

namespace App\Http\Controllers;

use App\Actions\UpsertAppAction;
use App\DataTransferObject\AppData;
use App\Http\Requests\UpsertAppRequest;
use App\Http\Resources\AppResource;
use App\Models\App;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AppsController extends Controller
{

    public function __construct(
        public readonly UpsertAppAction $upsertAppAction
    )
    {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertAppRequest $request):JsonResponse
    {
        return AppResource::make($this->upsert($request, new App()))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpsertAppRequest $request, App $app):Response
    {
        $user = Auth::user();
        if($app->user_id != $user->id){
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $this->upsert($request, $app);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function upsert(
        UpsertAppRequest $request,
        App $app
    )
    {
        $appData = new AppData(...$request->validated());
        return $this->upsertAppAction::execute($appData, $app);
    }
}
