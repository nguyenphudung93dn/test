<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    //
    public function setCookie(Request $request){
        $minutes = 1;
        $html_page_set_cookie = 
        "<h1>Hello World.</h1>"
        ."<h3>Page Set Cookie </h3>"
        ."<a href='http://loctest.com/Blog_laravel/public/cookie/get'>Redirect page get value cookie</a>";
        $response = new Response($html_page_set_cookie);
        $response->withCookie(cookie('name', 'value cookie', $minutes));
        return $response;
     }
    public function getCookie(Request $request){
        $value = $request->cookie('name');
        echo "Value of Cookie : " .$value;
     }
}
