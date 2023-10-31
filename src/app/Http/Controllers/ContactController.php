<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Post $post)
    {
        return view('contact.create', ['post' => $post]);
    }

    public function store(Request $request)
    {

        $inputs=$request->validate([
            'title'=>'required|max:255',
            'email'=>'required|email|max:255',
            'body'=>'required|max:1000',
        ]);
        Contact::create($inputs);
        return view('contact.confirmation');
    }
}
