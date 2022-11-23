<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        
        return view('user.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'username' => ['required','string','unique:users'],
            'hp' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','string','min:5'],
            'role' => ['required'],
        ]);
        
        try{
             
            $user= new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->hp = $request->hp;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
        }
        catch(\Exception $e ){
            return redirect()->back()->with('errors','User gagal disimpan');
        }
        return redirect('user')->with('sukses','Akun Mu Tersimpan');
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
        $user = User::findOrFail($id);
        return view('user.edit')->withuser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','string'],
            'username' => ['required','string','unique:users,username,'.$id],
            'hp' => ['required'],
            'email' => ['required','email','unique:users,email,'.$id],
            'role' => ['required'],
        ]);

        try{
            $user= User::find($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->hp = $request->hp;
            $user->email = $request->email;
            if($request->password <> ''){
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role;
            $user->save();
        }
        catch(\Exception $e ){
            return redirect()->back()->with(['errors','User gagal disimpan']);
        }
        return redirect('user')->with('sukses','Akun Mu Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->id == $id){
            return redirect()->back()->with('errors','Gagal Menghapus User Sedang Digunakan');
        }else{
            try{
                $user = User::find($id);
                $user->delete();
            }
            catch(\Exception $e){
                return redirect()->back()->with('errors','User berhasil dihapus');
            }
            return redirect('user')->with('sukses','User berhasil dihapus');
        }
    }
}