<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Helpers\ApiFormatter;
use Exception;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $data = Variant::all();
        return ApiFormatter::buildResponse(200, "OK", $data, null);
    }

    public function store(Request $request)
    {
        try {
            $variant = Variant::create([
                "name" => $request->name
            ]);

            if (!$variant){
                return ApiFormatter::buildResponse(400, "BAD_REQUEST");
            }

            return ApiFormatter::buildResponse(200, "OK", $variant);
        }catch(Exception $e){
            return ApiFormatter::buildResponse(500, "INTERNAL_SERVER");
        }
    }

    public function show($id)
    {
        $data = Variant::where('id', $id)->first();
        if (!$data){
            return ApiFormatter::buildResponse(404, "NOT_FOUND");
        }
        return ApiFormatter::buildResponse(200, "OK", $data);
    }
}
