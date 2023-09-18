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
        $users = User::where('id','<>',auth()->user()->id)->get();
      return  view('users.index',compact('users'));
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
            return redirect()->route('user-all')->with(['success'=>'Data save successfully']);
        }catch (\Exception $ex){
            toastr()->error('There are error on data',['timeOut' => 8000]);
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }
    public function update(UserRequest $request,$id){
        try {
            $user = User::find($id);
            if(!$user){
                toastr()->warning('there are error on data');

                return redirect()->route('user-all')->with(['error' => "There are error on data"]);
            }
            $user->update($request->except('_token','id'));
            return redirect()->route('user-all')->with(['success' => "Data updated Successfully"]);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }

    public function delete(Request $request){
        try {
            $user = User::find($request->id);
            if(!$user){
                toastr()->warning('there are error on data');

                return redirect()->route('user-all')->with(['error' => "there are error on data"]);
            }
            toastr()->warning('User Delete');
            $user->delete();
            return redirect()->route('user-all')->with(['success' => "User delete successfully"]);
        }catch (\Exception $e){
            toastr()->warning('there are error on data');

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
