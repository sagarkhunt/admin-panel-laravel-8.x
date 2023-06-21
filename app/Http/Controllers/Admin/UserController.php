<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\Admin\AdminController;
use Validator;
use Auth;
use DB;
use View;
use Hash;
use File;
use Session;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->User::get();
        return view('admin.user.index',compact('data'));
        // if (request()->ajax()) {            
        //     $data = $this->Users->with('userRole','userRole.Role')->orderBy('id', 'desc')->get();                        
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($row){
        //             $actionBtn = '<a href="'. url("admin/users/".$row->id."/edit") .'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm delete_record" data-id='.$row->id.'>Delete</a>';
        //             return $actionBtn;
        //         })
        //         ->addColumn('role', function($row){
        //             $roles = $row['userRole']['role']['display_name'];                    
        //             return $roles;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        // if (request()->ajax()) {
        //     $lists = $this->User->orderBy('id', 'desc');
        //     if (request('searchtext')) {
        //         $search = request()->searchtext;
        //         $lists->where(function ($query) use ($search) {
        //             $query->orWhere('name', 'like', '%' . $search . '%')
        //                 ->orWhere('email', 'like', '%' . $search . '%');
        //         });
        //     }

        //     $lists = $lists->paginate(10);
        //     return response()->json(
        //         View::make('admin.users.raw', compact('lists'))
        //             ->render()
        //     );

        // }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'roles'=>'required',
            'profile_pic'=>'mimes:jpeg,bmp,png,gif'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request['password']);

        if ($request->file('profile_pic')) {

            $file = $request->file('profile_pic');
            $filename = 'user-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/user/'), $filename);
            $data['profile_picture'] = $filename;
        }
        $data['role_id'] = $data['roles'];
        $user = $this->User;
        $user->fill($data);
        $user->save();
        $this->success($this->created,'User');
        return redirect('admin/users');

        // if($user->save()){

        //     $clientrole = Role::where('id', $request['roles'])->first();
        //     $user->attachRole($clientrole);


        //     Session::flash('message','<div class="alert alert-success">User Created Successfully.!! </div>');
        //     return redirect('guru-admin/user');
        // }
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
        $data = $this->User::findorFail($id);
        return view('admin.user.edit',compact('data'));
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
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'roles'=>'required'
        ]);
        $role = $request['roles'];
        $data = $request->all();
        $data = $request->except('_token', '_method');
        $data['role_id'] = $request['roles'];

        if ($request->file('profile_pic')) {

            $oldimage = $this->User::where('id', $id)->value('profile_picture');

            if (!empty($oldimage)) {

                File::delete('storage/app/public/user/' . $oldimage);
            }

            $file = $request->file('profile_pic');
            $filename = 'user-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('storage/app/public/user', $filename);
            $data['profile_picture'] = $filename;
        }
        unset($data['profile_pic'],$data['roles']);
        $update = $this->User::where('id',$id)->update($data);
        $this->success($this->updated,'User');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $oldimage = $this->User::where('id', $id)->value('profile_picture');

        if (!empty($oldimage)) {

            File::delete('storage/app/public/user/' . $oldimage);
        }

        $delete = $this->User::where('id',$id)->delete();
        $this->error($this->deleted,'User');
        return redirect('admin/users');
        
    }

    /*
        Change user Status
    */
    public function statusChange($id){
        $users  = $this->User::findorFail($id);

        if($users['status'] == 'active'){
            $newStatus = 'deactive';
        } else {
            $newStatus = 'active';
        }
        
        $update = $this->User::where('id',$id)->update(['status'=>$newStatus]);

        if($update){
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> User status updated successfully. </div>');

            return redirect('admin/users');
        }
    }
}
