<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use DB;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Abstract World';
        return view ('pages.index')->with('title', $title);
    }

    public function about(){
        //$title = 'ABOUT US';
        return view ('pages.about');
    }

    public function services(){
        $data = array(
    
        'title' => 'OUR SERVICES',
        'services' => ['Web Design', 'Programming','SEO']
        );
        return view ('pages.services')->with($data);
    }
}
