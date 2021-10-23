<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequset;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sections = Section::all();
//        return $sections->products;
        $products = Product::with('section')->get();


        return view('products.products', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ProductRequset $request)
    {
//        return $request;
        $products = Product::create([
            "product_name" => $request->product_name,
            "description" => $request->description,
            "section_id" => $request->section_id,
        ]);
        return redirect()->back()->with('Add', 'تم اضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public
    function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public
    function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public
    function update(ProductRequset $request, Product $product)
    {
        $products = Product::findOrFail($request->pro_id);
//        return $request;
        $products->update([
            "product_name" => $request->product_name,
            "description" => $request->description,
            "section_id" => $request->section_id,
        ]);
        return redirect()->back()->with('edit', 'تم تعديل المنتج بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public
    function destroy(Request $request)
    {
        $products = Product::findOrFail($request->pro_id);
        $products->destroy($request->pro_id);
        return redirect()->back()->with('delete', 'تم الحذف المنتج بنجاح');


    }
}
