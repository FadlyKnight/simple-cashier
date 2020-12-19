<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();
        $data['price'] = str_replace('.','',$request->price);
        // dd($data);
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:50',
            'file' => 'required|mimes:jpeg,jpg,bmp,png,JPEG,JPG,BMP,PNG',
            'price' => 'required|numeric|digits_between:2,5',
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong',
            'name.min' => 'Nama Minimal 3 Huruf',
            'name.max' => 'Nama Maximal 50 Huruf',
            'file.required' => 'Gambar Tidak Boleh Kosong',
            'file.mimes' => 'Hanya Menerima File Berekstensi JPEG,JPG,BMP,PNG',
            'price.required' => 'Harga Tidak Boleh Kosong',
            'price.numeric' => 'Harga hanya boleh angka',
            'price.digits_between' => 'Harga Terlalu Tinggi atau Terlalu Rendah'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if ( request()->hasFile('file'))
        {   
            $foto_produk = date('m')."_".Str::random(12) .".". request()->file('file')->extension();
            $path = 'img/product';
            $request->file->move(public_path($path), $foto_produk);
            $data['file'] =  $path.'/'.$foto_produk;
        }

        Product::create($data);
        return redirect()->route('product.index')->with('success','Produk Berhasil dibuat');

    }

    public function index()
    {
        $data = \DB::table('product');
        return view('content.product.index', compact('data'));
    }
}
