<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use ImageUpload; //Using our created Trait to access inside trait method
 
    public function store(Request $request)
    {
        $this->validate($request,[
            'file'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
 
        $data = new Image;
 
        $data->image = $request->file;
        if($data->image){
           try {
                $filePath = $this->UserImageUpload($data->image); //Passing $data->image as parameter to our created method
                $data->image = $filePath;
                $data->type = $request->type;
                $data->immobile_id = $request->immobile_id;
                $data->save();
                return redirect()->back()->with('success', 'Arquivo anexado com sucesso!');
 
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Ocorreu um erro');
            }
        }
    }

    public function delete($id){
        if(auth()->user()->adm<>1)
            return back()->with('warning','Acesso Negado');
        else{
            $images=Image::find($id);
            if(unlink(public_path($images->image))){
                $images->delete();
                return redirect()->back()->with('success', 'Arquivo deletado com sucesso!');
            }
            else{
                return redirect()->back()->with('error', 'Ocorreu um erro');
            }
        }
    }
}
