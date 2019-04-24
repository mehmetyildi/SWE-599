<?php
/**
 * Created by PhpStorm.
 * User: mehme
 * Date: 15.04.2019
 * Time: 08:58
 */
namespace App\Http\Controllers;



class HomeController extends Controller{
    public function home(){
        return view('home');
    }
}
