<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{

    public function __construct(
        protected ProductCategoryService $service
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => $this->service->indexCategory(),
            'status' => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validateRequest = $request->validate([
                'title' => 'required|string|min:3',
                'description' => 'required|string|min:3'
            ]);

            $category = $this->service->createCategory($validateRequest);

            return response()->json([
                'message' => 'Categoria criada com sucesso!',
                'data' => $category,
                'status' => 200
            ], 200);

        }catch(\Exception $error){
            return response()->json([
                'message' => 'Erro ao criar categoria: '.$error->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
