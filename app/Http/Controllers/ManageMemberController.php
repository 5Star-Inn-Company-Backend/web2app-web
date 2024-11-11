<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertMemberRequest;
use App\Http\Resources\MemberResource;
use App\Mail\InvitationMailToMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return MemberResource::collection(User::where('user_id', auth()->id())->with('role')->get());
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
        $password = Str::random(10);
        $user = User::create(array_merge($validatedData, [
            'user_id' => auth()->id(), 
            'password' => Hash::make($password),
            
        ]));
                Mail::to($user->email)->send(new InvitationMailToMember($user, $password));
        return new MemberResource($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $member)
    {
        return new MemberResource($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpsertMemberRequest $request, string $member)
    {        
        $userMember = User::where('id', $member)->first();
        if(empty($userMember)){
            return response()->json([
                'error' => 'Member not found',
               'status' => false
            ]);
        }
        if($userMember->user_id !== auth()->id())
        {
            return response()->json([
                'error' => 'You are not allowed to update this member',
               'status' => false
            ]);
        }
        $userMember->update($request->validated());
        return new MemberResource($userMember);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $member)
    {
        $userMember = User::where('id', $member)->first();
        if(empty($userMember)){
            return response()->json([
                'error' => 'Member not found',
               'status' => false
            ]);
        }
        if($userMember->user_id !== auth()->id())
        {
            return response()->json([
                'error' => 'You are not allowed to delete this member',
               'status' => false
            ]);
        }
        $userMember->delete();
        return ['Member deleted successfully'];
    }
}
