<?php

namespace App\Models\Frontend;

use App\Models\Admin\Pet;
use App\Models\Admin\UserPet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class UserPetController extends Model
{
    use HasFactory;

    public function index()
    {
        if(!session()->has('user')) {
            return redirect('/');
        }
        $pets = UserPet::join('pets', 'user_pets.pet_id', '=', 'pets.id')->where('user_pets.user_id', session('user')['id'])
            ->get();
        return view('frontend.userpet', compact('pets'));
    }

    public function searchPet(Request $req)
    {

        $res = Pet::where('name', 'LIKE', '%' . $req->search . '%')->get();
        return ['msg' => $res];
    }

    public function addPet(Request $req)
    {
        // $path = $req->file('filePath')->store('uploads','public');
        // Pet::create([
        //     'name'=>'parrot',
        //     'status'=>'1',
        //     'location'=>'Nepal',
        //     'imageFile'=>$path,
        // ]); 

        // return redirect('/');
        if (count(UserPet::where('user_id', session('user')['id'])->get())) {
            UserPet::where('user_id', session('user')['id'])->delete();
        }
        if ($req->list) {

            foreach ($req->list as $l) {
                UserPet::create([
                    'user_id' => session('user')['id'],
                    'pet_id' => $l
                ]);
            }
        }
        return ['msg' => 'success'];
    }
}
