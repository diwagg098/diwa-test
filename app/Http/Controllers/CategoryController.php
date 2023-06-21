<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Requests\Category\CategoryValidationRequest;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return ApiFormatter::buildResponse(200, "OK", $data, null);
    }

    public function store(CategoryValidationRequest $request)
    {
        try {
            $category = Category::create([
                "name" => $request->name
            ]);

            if (!$category) {
                return ApiFormatter::buildResponse(400, "BAD_REQUEST", null, null);
            }

            return ApiFormatter::buildResponse(200, "OK", $category, null);
        }catch (Exception $e){
            return ApiFormatter::buildResponse(500, "INTERNAL_SERVER");
        }
    }

    public function show($id)
    {
        $data = Category::where('id', $id)->first();
        if (!$data) {
            return ApiFormatter::buildResponse(404, "NOT_FOUND");
        }

        return ApiFormatter::buildResponse(200, "OK", $data);
    }
}
