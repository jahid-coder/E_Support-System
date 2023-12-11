<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      
      $user=User::orderBy('id','DESC')->paginate(5);
      return view('admin.user.index',compact('user'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    // User Create 
    public function create()
    {
        $roles = Role::pluck('rolename','rolename')->all(); //DB::table('categories')->get();
        // dd( $users);
        return view('admin.user.create',compact('roles'));
    }


     //data store
     public function store(Request $request)
     {
       
        $validated =  $request-> validate([
            'role_id'=>'required',
            'userid'=>'required|unique:users|max:20',
            'name'=>'required',
            'email'=>'required|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

       
       
       $user = new User;
       $user->role_id = $request->role_id;
       $user->userid = $request->userid;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->save();
        
         $notification = array('messege' =>'user Inserted!','alert-type'=>'success');
         return redirect()->route('user.index')->back()->with($notification);
     }


    // data destory
    public function destroy($id)
    {
        User::destroy($id);
        $notification = array('messege' =>'Sub Category deleted!','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
    //edit 
    public function edit($id)
    {
        $roles=Role::pluck('rolename','rolename')->all();
        $data = User::find($id);
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('roles','data','userRole'));
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id); // get the record

        $user->role_id = $request->role_id;
        $user->userid = $request->userid;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $notification = array('messege' =>'user Updated!','alert-type'=>'success');
        return redirect()->route('user.index')->with($notification);

    }
}
