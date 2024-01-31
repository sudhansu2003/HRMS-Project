<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test()
    {
        echo 123;exit;
        $data = ['message' => 'Hello, This is a message from the controller!'];

        return view('testfile',$data);
    }
    public function Addition($num1,$num2)
    {
        $sum = $num1 + $num2;
        return view('testfile',['num1'=>$num1,'num2'=>$num2,'sum'=>$sum]);
    }
}
