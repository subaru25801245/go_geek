<?php

namespace App\Http\Controllers;

use App\Models\Campany;
use Illuminate\Http\Request;


class CampanyController extends Controller
{
    public function index()
    {
        $campanies = Campany::get();

        foreach($campanies as $campany){
            $name = $campany->name;
        }

        return view('campany.index', compact('campanies'));

        //var_dump($tests);
    }

    public function create(){
        return view('campany.create');
    }

    public function store(Request $request){
        $campany = new Campany();
        $campany->name = $request->input('name');
        $campany->text = $request->input('text');

        $campany->save();

        return redirect('/campanies');

    }

    public function show(int $campany_id)
    {
        $campany = Campany::find($campany_id);

        return view('campany.show', compact('campany'));
    }

    public function edit(Request $request, int $campany_id){

        $campany  = Campany::find($campany_id);
        return view('campany.edit', compact('campany'));
    }

    public function update(Request $request, int $campany_id)
    {
        $campany = Campany::find($campany_id);
        $campany->name = $request->input('name');
        $campany->text = $request->input('text');

        $campany->save();

        return redirect("/campanies");
    }

    public function destroy(int $campany_id){
        $campany = Campany::find($campany_id);
        $campany->delete();
        return redirect("/campanies");
    }
}
