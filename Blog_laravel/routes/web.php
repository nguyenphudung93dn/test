<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test_route',function(){
    return 'Hello world';
});

Route::get('tester/route_2',function(){
    echo "<h1>Laravel test route </h1>";
});
//truyen tham so
Route::get('HoTen/{ten}',function($ten){
    echo "Ten cua ban La: ".$ten;
});

Route::get('Laravel/{ngay}',function($ngay){
    echo "Khoa Pham: " .$ngay;
})->where(['ngay'=>'[0-9]+']);


//dinh danh
Route::get('Route1',['as'=>'MyRoute',function(){
    echo "hello your " ;
}]);

Route::get('goiten',function(){
    return redirect()->route('MyRoute');
});
//dinh danh c2
Route::get('Route2',function(){
    echo "đây là route 2 " ;
})->name('MyRoute2'); 

Route::get('goiten2',function(){
    return redirect()->route('MyRoute2');
});
//tao nhom dinh danh
Route::group(['prefix'=>'MyGroup'],function(){
    Route::get('User1',function(){
        echo 'USER1';
    });
    Route::get('User2',function(){
        echo 'USER2';
    });
    Route::get('User3',function(){
        echo "User3";
    });
});

//route goi controller
Route::get('GoiController','MyController@XinChao');

Route::get('thamso/{ten}','MyController@KhoaHoc');

Route::get('MyRequest','MyController@GetURL');

//gui va nhan du lieu
Route::get('getForm',function(){
    return view('postForm');
});

//Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);
//or write line same like under
Route::post('postForm', 'MyController@postForm')->name('postForm');

//route ageMidlewware
Route::get('Age',[
    'middleware' => 'Age:editor',
    'uses' => 'MyControllers@index_ageMidlewware',
 ]);