<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function accessSessionData(Request $request){
        if($request->session()->has('my_name')) {
            echo $request->session()->get('my_name');
        }
        else {
            echo 'No data in the session';
            echo '<br><p>Create new session by URL under</p>';
            echo '<a href="http://loctest.com/Blog_laravel/public/session/set">Set session</a>';
        }

     }
     public function storeSessionData(Request $request){
        $request->session()->put('my_name','Virat Gandhi');
        echo "Data has been added to session";
        echo '<br><a href="http://loctest.com/Blog_laravel/public/session/remove" >Delete session </a>';
        echo '<br><a href="http://loctest.com/Blog_laravel/public/session/get" >Get value session </a>';
     }
     public function deleteSessionData(Request $request){
        $request->session()->forget('my_name');
        echo "Data has been removed from session.";
        echo '<br><a href="http://loctest.com/Blog_laravel/public/session/set" >SET new value session </a>';
     }
}
