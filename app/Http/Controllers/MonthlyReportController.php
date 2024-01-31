<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class MonthlyReportController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Monthly Report'))
        {
            return view('monthlyreport.index');
        }
        else
        {
            echo 9;exit;
        }
    }
}