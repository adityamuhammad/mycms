<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateUsersRequest;
use App\Role;
use Auth;
use Session;
use App\Photo;

class SettingsController extends Controller
{
    public function profile(){
        $roles = Role::lists('name', 'id')->all();

        return view('settings.profile', compact('roles'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'photo_id' => 'image'
        ]);
        if(trim($request->password) == ''){
            $input = $request->except('password');

        } 
        $input =  $request->all();
        $input['is_active'] = 1;
        $input['password'] = bcrypt($request->password);
        

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);

            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "$user->name has been updated"
        ]);

        return redirect('/home');

    }
}
