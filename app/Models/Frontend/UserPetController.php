<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPetController extends Model
{
    use HasFactory;
    
    public function index() {
        return view('frontend.userpet');
    }
}
