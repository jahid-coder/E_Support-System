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
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) : View
    {
      
        $user = User::latest()->paginate(5);
        return view('admin.user.index',compact('user'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    // User Create 
    public function create(): View
    {
        $roles = Role::pluck('rolename','rolename')->all(); //DB::table('categories')->get();
        // dd( $users);
        return view('admin.user.create',compact('roles'));
    }


     //data store
     public function store(Request $request): RedirectResponse
     {
       
        // $validated =  $request-> validate([
        //     'role_id'=>'required',
        //     'userid'=>'required|unique:users|max:20',
        //     'name'=>'required',
        //     'email'=>'required|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

       
       
    //    $user = new User;
    //    $user->role_id = $request->role_id;
    //    $user->userid = $request->userid;
    //    $user->name = $request->name;
    //    $user->email = $request->email;
    //    $user->password = Hash::make($request->password);
    //    $user->save();


        $this->validate($request, [
            'name' => 'required',
            'userid'=>'required|unique:users|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
         $notification = array('messege' =>'user Inserted!','alert-type'=>'success');
         return redirect()->route('user.index')->back()->with($notification);
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):View
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }
    

    //edit 
    public function edit($id): View
    {
        $roles=Role::pluck('rolename','rolename')->all();
        $data = User::find($id);
        $userRole = $user->roles->pluck('rolename','rolename')->all();
        return view('admin.user.edit',compact('roles','data','userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // $user=User::find($id); // get the record

        // $user->role_id = $request->role_id;
        // $user->userid = $request->userid;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'role_id' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));

        $notification = array('messege' =>'user Updated!','alert-type'=>'success');
        return redirect()->route('user.index')->with($notification);

    }

    // data destory
    public function destroy($id): RedirectResponse
    {
        User::destroy($id);
        $notification = array('messege' =>'User deleted!','alert-type'=>'success');
        return redirect()->route('user.index')->back()->with($notification);

    }
}
