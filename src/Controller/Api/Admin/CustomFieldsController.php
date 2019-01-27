<?php
namespace App\Controller\Api\Admin;

use App\Entity;
use App\Controller\Api\AbstractGenericCrudController;
use App\Http\Request;
use App\Http\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @see \App\Provider\ApiProvider
 */
class CustomFieldsController extends AbstractGenericCrudController
{
    protected $entityClass = Entity\CustomField::class;
    protected $resourceRouteName = 'api:admin:custom_field';

    /**
     * @OA\Get(path="/admin/custom_fields",
     *   tags={"Administration: Custom Fields"},
     *   description="List all current custom fields in the system.",
     *   @OA\Response(response=200, description="Success",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CustomField"))
     *   ),
     *   @OA\Response(response=403, description="Access denied"),
     *   security={{"api_key": {}}},
     * )
     *
     * @OA\Post(path="/admin/custom_fields",
     *   tags={"Administration: Custom Fields"},
     *   description="Create a new custom field.",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/CustomField")
     *   ),
     *   @OA\Response(response=200, description="Success",
     *     @OA\JsonContent(ref="#/components/schemas/CustomField")
     *   ),
     *   @OA\Response(response=403, description="Access denied"),
     *   security={{"api_key": {}}},
     * )
     *
     * @OA\Get(path="/admin/custom_field/{id}",
     *   tags={"Administration: Custom Fields"},
     *   description="Retrieve details for a single custom field.",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="Success",
     *     @OA\JsonContent(ref="#/components/schemas/CustomField")
     *   ),
     *   @OA\Response(response=403, description="Access denied"),
     *   security={{"api_key": {}}},
     * )
     *
     * @OA\Put(path="/admin/custom_field/{id}",
     *   tags={"Administration: Custom Fields"},
     *   description="Update details of a single custom field.",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/CustomField")
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="Success",
     *     @OA\JsonContent(ref="#/components/schemas/Api_Status")
     *   ),
     *   @OA\Response(response=403, description="Access denied"),
     *   security={{"api_key": {}}},
     * )
     * @OA\Delete(path="/admin/custom_field/{id}",
     *   tags={"Administration: Custom Fields"},
     *   description="Delete a single custom field.",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="Success",
     *     @OA\JsonContent(ref="#/components/schemas/Api_Status")
     *   ),
     *   @OA\Response(response=403, description="Access denied"),
     *   security={{"api_key": {}}},
     * )
     */
}