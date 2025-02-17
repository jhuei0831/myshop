<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Product;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('product.index', compact('products'));
    }
    public function table()
    {
        $products = Product::paginate(12);
        return view('product.table', compact('products'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('title', $search)
                    ->orWhere('price', 'like', '%' . $search . '%')->paginate(12)->appends($request->all());
        // $products = DB::table('products')->where('title', 'like', '%' . $search . '%')->paginate(12);
        return view('product.index', compact('products'));
    }
    public function search_table(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('title', $search)
                    ->orWhere('price', 'like', '%' . $search . '%')->paginate(12)->appends($request->all());
        // $products = DB::table('products')->where('title', 'like', '%' . $search . '%')->paginate(12);
        return view('product.table', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (isset($product) && !$product->on_sale) {
            throw new CustomException('商品未上架');
        }

        return view('product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
