<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use DB;


class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       // query builder
       //$role = DB::table('roles')->get();
      //elequent
      $role=role::all();

      return view('admin.role.index',compact('role'));

    }
    
    //create 

    public function Create()
    {
        return view('admin.role.create');

    }

    // //data store
    public function store(Request $request)
    {
       $validated =  $request-> validate([
            'rolename'=>'required | unique:roles|max:255',
        ]);

       
       $role = new Role;
       $role->rolename = $request->rolename;
       $role->save();

        $notification = array('messege' =>'role Inserted!','alert-type'=>'success');
        return redirect()->back()->with($notification);

        //return redirect()->back()->with('success','successfully inserted!');
    }


    // //data edit
    public function edit($id)
    {
        
        // $data =DB::table('categories')->where('id',$id)->first();
        // $data=Category::find($id);
        $data=role::where('id',$id)->first();
        return view('admin.role.edit',compact('data'));

    }

    // // data update

    public function update(Request $request,$id)
    {
        $role=Role::find($id); // get the record

        $role->rolename = $request->rolename;
        $role->save();

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
        return redirect()->back()->with($notification);

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
