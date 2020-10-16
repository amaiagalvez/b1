<?php

namespace Izt\Basics\Http\Controllers;

class BasicsController extends Controller
{

    public function home()
    {
        return view('basics::back');
    }

}
