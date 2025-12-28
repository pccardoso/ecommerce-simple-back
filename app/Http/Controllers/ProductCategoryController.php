<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use OpenApi\Annotations as OA;

class ProductCategoryController extends Controller
{

    public function __construct(
        protected ProductCategoryService $service
    ){}

    /**
     * @OA\Get(
     *     path="/product-category",
     *     summary="Listar todas as categorias de Produto",
     *     description="Retorna todas as categorias de produtos cadastradas no sistema",
     *     tags={"Categorias de Produtos"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de categorias",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id", 
     *                      type="integer", 
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                      property="title", 
     *                      type="string", 
     *                      example="Categoria A"
     *                  ),
     *                  @OA\Property(
     *                      property="description", 
     *                      type="string", 
     *                      example="Descrição da categoria A"
     *                  ),
     *              )
     *         )
     *     ),
     * )
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
     * @OA\Post(
     *     path="/product-category",
     *     summary="Criar uma nova categoria de produto",
     *     description="Cria uma nova categoria de produto com título e descrição",
     *     tags={"Categorias de Produtos"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados da categoria",
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 minLength=3,
     *                 example="Rastreamento"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 minLength=3,
     *                 example="Categoria relacionada a serviços de rastreamento"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categoria criada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categoria criada com sucesso!"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Rastreamento"),
     *                 @OA\Property(property="description", type="string", example="Categoria relacionada a serviços de rastreamento")
     *             ),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno ao criar categoria"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/product-category/{id}",
     *     summary="Remover uma categoria de produto",
     *     description="Remove uma categoria de produto pelo ID",
     *     tags={"Categorias de Produtos"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categoria removida com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categoria removida com sucesso!"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     * )
     */

    
    public function destroy(string $id)
    {
        $this->service->deleteCategory($id);

        return response()->json([
            'message' => 'Categoria removida com sucesso!',
            'status' => 200
        ], 200);
    }
}
