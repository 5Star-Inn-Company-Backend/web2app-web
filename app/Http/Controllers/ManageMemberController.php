<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertMemberRequest;
use App\Http\Resources\MemberResource;
use App\Mail\InvitationMailToMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ManageMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new MemberResource(User::with('role')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertMemberRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create(array_merge($validatedData, ['password' => Str::random(10)]));
        Mail::to($user->email)->send(new InvitationMailToMember($user));
        return new MemberResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new MemberResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpsertMemberRequest $request, User $user)
    {
        $user->update($request->validated());
        return new MemberResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ['Member deleted successfully'];
    }
}
