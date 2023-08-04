<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/11/23 .
 * Time: 8:21 PM .
 */

namespace App\Service;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public static function index(Request $request)
    {
        Log::info("----------- params: ". json_encode($request->all()));
        $products = Product::with('category:id,name,slug');

        if ($request->category_id)
            $products->where('category_id', $request->category_id);

        if ($request->keyword)
            $products->where('name','like','%'.$request->keyword.'%');

        $products = $products->paginate(20);
        return new ProductCollection($products);
    }

    public static function show(Request $request, $id)
    {
        $product = Product::find($id);
        return  new ProductResource($product);
    }
}
