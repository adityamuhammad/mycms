<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Session;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::paginate(5);
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);
        Photo::create([
            'file'=>$name
        ]);
        
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file);
        $photo->delete();

        Session::flash("flash_notification", [
                "level" => "success",
            "message" => "Photo has been deleted"
        ]);

        return redirect('admin/media');

    }

    public function deleteMultiple(Request $request)
    {
        if(isset($request->delete_single)){
            $this->destroy($request->photo);
            return redirect()->back();
        }

        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){
                $photo->delete(); 
            }
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Photos has been deleted"
            ]);
            return redirect()->back();
        } else {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Before you do that, Please select the photo"
            ]);

            return redirect()->back();
        }

    }



}
