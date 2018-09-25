<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function XinChao(){
        echo 'Chao cac ban';
    }

    public function KhoaHoc($ten){
        echo "ten khoa hoc la:" .$ten;
        return redirect()->route('MyRoute');
    }

    public function GetURL(Request $request){
        //return $request->path();
        //return $request->url();

        // if($request->isMethod('post')){
        //     echo 'POST';
        // }else{
        //     echo 'GET';
        // }

        if($request->is('My*')){
            echo 'co My';
        }else {
            echo 'ko co my';
        }
    }

    public function postForm(Request $request){
        //echo "Ten cua Ban La: ";
        //echo $request->hoten;
        
        //get array
        // var_dump($request->all());

        
        //check ton tai tham so nao do hay ko
        if($request->has('hotenv')){
            echo 'co ton tai';
        }else{
            echo 'chua ton tai';
        }
    }
}
