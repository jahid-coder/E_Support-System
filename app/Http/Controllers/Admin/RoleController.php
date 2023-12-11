<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Role;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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

    public function index()
    {
       // query builder
       //$role = DB::table('roles')->get();
      //elequent
      $role=Role::orderBy('id','DESC')->paginate(5);
      return view('admin.role.index',compact('role')) ->with('i', ($request->input('page', 1) - 1) * 5);

    }
    
    //create 

    public function Create()
    {
        $permission = Permission::get();
        return view('admin.role.create',compact('permission'));

    }

    // //data store
    public function store(Request $request)
    {
        $this->validate($request, [
            'rolename' => 'required|unique:roles,rolename',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['rolename' => $request->input('rolename')]);
        $role->syncPermissions($request->input('permission'));
    

        $notification = array('messege' =>'role Inserted!','alert-type'=>'success');
        return redirect()->route('role.index')->back()->with($notification);

        //return redirect()->back()->with('success','successfully inserted!');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }


    // //data edit
    public function edit($id)
    {
        
        
        $data=Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.role.edit',compact('data','permission','rolePermissions'));

    }

    // // data update

    public function update(Request $request,$id)
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
    public function destroy($id)
    {

        // DB::table('categories')->where('id',$id)->delete();
        // return redirect()->back();
        // $category=Category::find($id); // get the record
        // $category->delete();

        Role::destroy($id);
        $notification = array('messege' =>'role deleted!','alert-type'=>'success');
        return redirect()->route('roles.index')->back()->with($notification);

        // // $category->update([
        // //     'category_name'=>$request->category_name,
        // //     'category_slug' =>Str::of($request->category_name)->slug('-'),
        // // ]);

        // $category->category_name = $request->category_name;
        // $category->category_slug = Str::of($request->category_name)->slug('-');
        // $category->save();

        // return redirect()->route('category.index');

    }

}
