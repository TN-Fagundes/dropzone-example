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
        
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    public function dropzoneDestroy(Request $request)
    {
        $fileName = $request->input('file_name');
        
        $filePath = public_path('images') . '/' . $fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
            return response()->json(['success' => 'Arquivo excluído com sucesso']);
        }

        return response()->json(['error' => 'O arquivo não foi encontrado']);
    }
}
