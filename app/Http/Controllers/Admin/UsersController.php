<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage users';
        $this->resources['roleArr'] = $utilityService->getAllUserRoles();
    }

    public function usersAllView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = User::orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.user_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function usersAddView(Request $request)
    {
        try{
            return view('admin.user_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function usersInfoView(Request $request)
    {
        try{
            $obj = User::find($request->id);
            if ($obj != null){
                $this->resources['obj'] = $obj;
                return view('admin.user_update')->with($this->resources);
            }else{
                return view('error_pages.404');
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function usersAdd(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required']
            ], $this->messages());

            if (!$validator->fails()) {

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->password = Hash::make($request->password);
                $user->save();

                $this->resources['common_msg'] = $this->successWithMessage('User added successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function usersUpdate(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'role' => ['required']
            ], $this->messages());

            if (!$validator->fails()) {

                $user = User::find($request->id);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->role = $request->role;
                $user->save();

                $this->resources['common_msg'] = $this->successWithMessage('User updated successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function usersDelete(Request $request)
    {
        try{
            User::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('User deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'first_name.max' => 'First name may not be greater than 100 characters.',
            'last_name.max' => 'Last name may not be greater than 100 characters.',
            'email.unique' => 'This email is already connected to an account.'
        ];
    }
}
