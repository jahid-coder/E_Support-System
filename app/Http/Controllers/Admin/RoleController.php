<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Role;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;



class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
      
      $role = Role::orderBy('id','DESC')->paginate(10);
      return view('admin.role.index',compact('role'));

    }
    
    //create 

    public function Create(): View
    {
        $permission = Permission::get();
        return view('admin.role.create',compact('permission'));

    }

    // //data store
    public function store(Request $request): RedirectResponse
    {
       
        //dd($request);
        $this->validate($request, [
            'rolename' => 'required|unique:roles,rolename',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['rolename' => $request->input('rolename')]);
    
         //$role->syncPermissions($request->input('permission'));
    

        $notification = array('messege' =>'role Inserted!','alert-type'=>'success');
        return redirect()->route('role.index')->with($notification);

        //return redirect()->back()->with('success','successfully inserted!');
    }

    public function show($id): View
    {
        $roles = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
         return view('admin.role.show',compact('roles','rolePermissions'));
    }


    // //data edit
    public function edit($id): View
    {
        
        
        $data=Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.role.edit',compact('data','permission','rolePermissions'));

    }

    // // data update

    public function update(Request $request,$id): RedirectResponse
    {
        $this->validate($request, [
            'rolename' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->rolename = $request->input('rolename');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));

        $notification = array('messege' =>'role Updated!','alert-type'=>'success');
        return redirect()->route('role.index')->with($notification);

    }

    // // data destory
    public function destroy($id): RedirectResponse
    {

       //dd($id);
        Role::destroy($id);
        $notification = array('messege' =>'role deleted!','alert-type'=>'success');
        return redirect()->route('role.index')->with($notification);

       

    }

}
