<?php

namespace App\Models\Frontend;

use App\Models\Admin\Pet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class UserPetController extends Model
{
    use HasFactory;
    
    public function index() {
        return view('frontend.userpet');
    }

    public function searchPet(Request $req) {

        $res = Pet::where('name','LIKE','%'.$req->search.'%')->get();
        return ['msg'=>$res];
    }

    public function addPet(Request $req) {
        // $path = $req->file('filePath')->store('uploads','public');
        // Pet::create([
        //     'name'=>'parrot',
        //     'status'=>'1',
        //     'location'=>'Nepal',
        //     'imageFile'=>$path,
        // ]); 

        // return redirect('/');
        return ['msg'=>$req->input()];
    }

    
}
