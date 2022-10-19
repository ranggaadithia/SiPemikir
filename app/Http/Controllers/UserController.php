<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\SosmedController;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Foreach_;

class UserController extends Controller
{
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Sosmed $sosmed)
    {
        return view('user.edit', compact('user', 'sosmed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Sosmed $sosmed)
    {

        

        for ($i = 1; $i <= $sosmed->count(); $i++) {
        $user->sosmed()
            ->where('user_id', $user->id)
            ->where('id', request()->input("id_sosmed_$i"))
            ->update([
                'link' => request()->input("sosmed_$i")
            ]);
        };

        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'profile_picture' => 'image|file|max:25000',
            'bio' => 'required',
            'banner' => 'image|file|max:5000'
        ];

        $validated = $request->validate($rules);

        if($request->file('profile_picture')) {
            
            if($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile-img');
        }

        if($request->file('banner')) {
            if($user->banner) {
                Storage::delete($user->banner);
            }
            $validated['banner'] = $request->file('banner')->store('banner-profile');
        }

        User::where('id', $user->id)->update($validated);
        return redirect('/dashboard/users/'. $user->username .'/edit')->with('success', 'Your Profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
