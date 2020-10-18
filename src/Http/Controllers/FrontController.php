<?php

namespace Izt\Basics\Http\Controllers;

class FrontController extends Controller
{

    public function home()
    {
        return view('basics::front');
    }

}
