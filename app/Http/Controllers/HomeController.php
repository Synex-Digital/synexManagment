<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function users()
    {
        return redirect()->route('dashboard');
        // $users = User::whereDoesntHave('employees')->get();
        // $roles = Role::all();
        // return view('dashboard.user.index',compact('users','roles'));
    }

    public function userStore(Request $request){
        return redirect()->route('dashboard');
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed |min:6',
        //     'password_confirmation' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     foreach ($errors->messages() as  $messages) {
        //         foreach ($messages as $message) {
        //             flash()->options([
        //                 'position' => 'bottom-right',
        //             ])->error($message);
        //         }
        //     }
        //     return back()->withErrors($validator)->withInput();
        // }
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        // flash()->options(['position' => 'bottom-right'])->success('User created successfully');
        // return back();
    }

    public function userDelete($id){
        return redirect()->route('dashboard');
        // $user = User::find($id);
        // $user->delete();
        // flash()->options(['position' => 'bottom-right'])->success('User deleted successfully');
        // return back();
    }

}
