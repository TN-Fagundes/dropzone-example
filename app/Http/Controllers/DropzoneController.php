<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function dropzone()
    {
        return view('dropzone');
    }

    public function dropzoneStore(Request $request)    
    {        
        $image = $request->file('file');
        if($image)
        {
            $imageName = time(). '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
    
            return response()->json(['success' => $imageName]);
        }
    }
}
