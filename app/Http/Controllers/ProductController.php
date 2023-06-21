<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Models\Product;
use Exception;
use App\Http\Requests\Product\ProductValidationRequest;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return ApiFormatter::buildResponse(200, "OK", $data, null);
    }

    public function store(ProductValidationRequest $request)
    {
        try {
            $product = Product::create([
                "name" => $request->name
            ]);

            if (!$product) {
                return ApiFormatter::buildResponse(400, "BAD_REQUEST", null, null);
            }
            return ApiFormatter::buildResponse(200, "OK", $product, null);
        }catch(Exception $e){
            return ApiFormatter::buildResponse(500, "INTERNAL_SERVER");
        }
    }

    public function show($id)
    {
        $data = Product::where('id', $id)->first();
        return ApiFormatter::buildResponse(200, "OK", $data, null);
    }
}
