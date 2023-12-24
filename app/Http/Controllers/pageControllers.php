<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageControllers extends Controller
{
    public function index(){
        return view("pages.index");
    }

    public function about(){
        return view("pages.about");
    }

    public function services(){
        // $services = array('web applicaiton', 'mobile application', 'data base'); //not working
        $data = array('services'=>['web applicaiton', 'mobile application', 'data base']);
        // return view("pages.servicees",$data); //not working
        return view("pages.services")->with($data); 
    }
}
