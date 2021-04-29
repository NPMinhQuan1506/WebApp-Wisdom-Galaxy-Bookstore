<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return View('pages.home');
    }
}
