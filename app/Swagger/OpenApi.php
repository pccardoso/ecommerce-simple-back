<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 * title="API E-commerce Simple",
 * version="1.0.0",
 * description="Documentação da API"
 * )
 *
 * @OA\Server(
 * url="http://localhost:8080/api",
 * description="Servidor de Homologação"
 * )
 *
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="JWT"
 * )
 */
class OpenApi {}