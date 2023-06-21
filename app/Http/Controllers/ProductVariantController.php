<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Requests\ProductVariant\ProductVariantValidationRequest;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_variants = ProductVariant::all();

        $data = [];
        foreach ($product_variants as $product_variant) {
            $product_name = $product_variant->product->name;
            $index = array_search($product_name, array_column($data, 'product_name'));

            if ($index === false){
                $data[] = [
                    'product_id' => $product_variant->product_id,
                    'product_name' => $product_name,
                    'product_details' => [
                        [
                            'variant' => $product_variant->variant->name,
                            'price' => $product_variant->price,
                            'stock' => $product_variant->stock,
                            'status' => $product_variant->status
                        ]
                    ]
                ];
            }else{
                $data[$index]['product_details'][] = [
                    'variant' => $product_variant->variant->name,
                    'price' => $product_variant->price,
                    'stock' => $product_variant->stock,
                    'status' => $product_variant->status
                ];
            }
        }
        
        return ApiFormatter::buildResponse(200, "OK", $data, null);
    }

    public function store(ProductVariantValidationRequest $request)
    {
        try {
            $data = ProductVariant::create([
                'category_id'=> $request->category_id,
                'variant_id' => $request->variant_id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => $request->status
            ]);

            if (!$data){
                return ApiFormatter::buildResponse(400, "BAD_REQUEST", null, null);
            }

            return ApiFormatter::buildResponse(200, "OK", $data, null);
        }catch(Exception $e){
            return ApiFormatter::buildResponse(500, "INTERNAL_SERVER");
        }
    }
}
