<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Support\Cropper;
use App\User;
use Illuminate\Http\Request;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());

        if (!empty($request->file('cover'))) {
            $user->cover = (string) $request->file('cover')->store('user');
        }

        $userCreated = User::create($request->all());

        if(!$userCreated){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.users.create')
            ->with(['color' => 'green', 'message' => 'Cliente inserido com sucesso!']);
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
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);

        $user->setAdminAttribute($request->admin);
        $user->setClientAttribute($request->client);

        if (!empty($request->file('cover')) && $user->cover) {
            Storage::delete($user->cover);
            Cropper::flush($user->cover);
        }

        $user->fill($request->all());

        if (!empty($request->file('cover'))) {
            $user->cover = (string) $request->file('cover')->store('user');
        }

        if(!$user->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.users.edit', $user->id)
            ->with(['color' => 'green', 'message' => 'Cliente atualizado com sucesso!']);
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

    public function team()
    {
        $users = User::team()->get();
        return view('admin.users.team', compact('users'));
    }
}
