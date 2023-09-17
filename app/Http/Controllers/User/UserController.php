<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\containsIdentical;

class UserController extends Controller
{
    public function index(){
        $users = User::get();

      return  view('users.index',compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(UserRequest $request){
        try {
            $user = User::create([
               'name' => $request->name,
               "email" => $request->email,
               "password" =>bcrypt($request->password),
                "mobile" => $request->mobile
            ]);
            Auth::login($user);
            Mail::to($request->email)->send(new UserMail());
            return redirect()->route('user-all')->with(['success' => "User create successfully And email send"]);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }
    public function edit($id){
        $user = User::whereId($id)->first();
        return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request,$id){
        try {
            $user = User::find($id);
            if(!$user){
                return redirect()->route('user-all')->with(['error' => "There are error on data"]);
            }
            $user->update($request->except('_token','id'));
            return redirect()->route('user-all')->with(['success' => "Data updated Successfully"]);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function delete($id){
        try {
            $user = User::find($id);
            if(!$user){
                return redirect()->route('user-all')->with(['error' => "there are error on data"]);
            }
            $user->delete();
            return redirect()->route('dashboard')->with(['success' => "User delete successfully"]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
