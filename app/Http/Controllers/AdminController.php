<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //chage password
    public function changePasswordPage()
    {
        return view('admin.accountInfo.changePassword');
    }
    //change password page
    public function changePassword(Request $request)
    {
        $this->validatePassword($request);
        $currentUserID = Auth::user()->id;
        $user = User::where('id', $currentUserID)->first();
        $dbPassword = $user->password;
        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with('success', 'Password Changed.');
        } else {
            return back()->with('notMatch', 'The Old Password not Match. Try again..');
        }
    }
    // Account Detail
    public function accountDetail($id){
        $data = User::where('id', $id)->first();
        return view('admin.accountInfo.detail', compact('data'));
    }
    // account list
    public function list()
    {
        $data = User::where('role', 'admin')->orderBy('created_at', 'desc')->paginate(4);;
        return view('admin.accountInfo.list', compact('data'));
    }
    // edit account
    public function edit($id)
    {
        $accountInfo = User::where('id', $id)->first();
        return view('admin.accountInfo.edit', compact('accountInfo'));
    }


    // update account
    public function updateDetails($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->accountGetData($request);
        if ($request->hasFile('image')) {
            //1 old image name | check = delete | store
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('account#detail');
    }
    // delete admin account
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['delete', 'Account Delete Success']);
    }
    // account change role
    public function changeRole($id)
    {
        $accountInfo = User::where('id', $id)->first();
        return view('admin.accountInfo.adminChangeRole', compact('accountInfo'));
    }

    public function change($id, Request $request)
    {
        $data = $this->changeRoleGetData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('account#list');
    }

    // user list
    public function usersList(){
        $data = User::where('role', 'user')->paginate(4);
    return view('admin.accountInfo.userList', compact('data'));
    }

    // account update get data
    private function accountGetData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
    // account update valitation update
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,bmp,png,jpeg'
        ])->validate();
    }
    // valitation password
    private function validatePassword($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword',
        ])->validate();
    }
    private function changeRoleGetData($request)
    {
        return [
            'role' => $request->role
        ];
    }
}