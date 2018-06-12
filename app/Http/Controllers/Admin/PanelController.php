<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Image;
use Hash;

class PanelController extends Controller
{
  public function account()
  {
    return view('admin.panel.account', array('user' => Auth::user()));
  }

  public function update(Request $request)
  {
    request()->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
    request()->avatar->move(public_path('uploads/avatar'), $imageName);

    $user = Auth::user();
    $user->avatar = $imageName;
    $user->save();
    return back()
          ->with('success','You have successfully upload profile picture.')
          ->with('avatar',$imageName);
  }

  public function change_password()
  {
    return view('admin.panel.change_password');
  }

  public function change_passwd(Request $request)
  {
    request()->validate([
          'old_password' => 'required',
          'new_password' => 'required|string|min:6|confirmed',
      ]);
    $user = Auth::user();
    if(!Hash::check($request->old_password, $user->password)){
      return back()->with("error","Your current password does not matches with the password you provided. Please try again.");
    }

    if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
      //Current password and new password are same
      return back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
    }

    $user->password = bcrypt($request->get('new_password'));
    $user->save();
    return back()
          ->with('success',"Password changed successfully !");
  }
}
