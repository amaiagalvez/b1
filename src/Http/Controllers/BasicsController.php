<?php

namespace Izt\Basics\Http\Controllers;

class BasicsController extends Controller
{

    public function basicshome()
    {
        return view('basics::back');
    }

    public function basicsfront()
    {
        return view('basics::front');
    }
}
