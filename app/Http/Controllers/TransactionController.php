<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    public function index()
    {
        $data = \DB::table('product');
        // dd($data);
        return view('content.transaction.index', compact('data'));
    }

}
