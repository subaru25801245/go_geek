<?php

namespace App\Http\Controllers;

use App\Models\Test;


class HirotoController extends Controller
{
    public function maro()
    {
        $tests = Test::get();

        foreach($tests as $test){
            $name = $test->name;
        }

        return view('test.maro', compact('tests'));

        //var_dump($tests);
    }
}
