<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProvinceAPIRequest;
use App\Http\Requests\API\UpdateProvinceAPIRequest;
use App\Models\Province;
use App\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProvinceController
 * @package App\Http\Controllers\API
 */

class ProvinceAPIController extends AppBaseController
{
    /** @var  ProvinceRepository */
    private $provinceRepository;

    function __construct(ProvinceRepository $provinceRepo)
    {
        $this->provinceRepository = $provinceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/provinces",
     *      summary="Get a listing of the Provinces.",
     *      tags={"Province"},
     *      description="Get all Provinces",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Province")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->provinceRepository->pushCriteria(new RequestCriteria($request));
        $this->provinceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $provinces = $this->provinceRepository->all();

        return $this->sendResponse($provinces->toArray(), "Provinces retrieved successfully");
    }

    /**
     * @param CreateProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/provinces",
     *      summary="Store a newly created Province in storage",
     *      tags={"Province"},
     *      description="Store Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Province that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Province")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Province"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProvinceAPIRequest $request)
    {
        $input = $request->all();

        $provinces = $this->provinceRepository->create($input);

        return $this->sendResponse($provinces->toArray(), "Province saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/provinces/{id}",
     *      summary="Display the specified Province",
     *      tags={"Province"},
     *      description="Get Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Province",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Province"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Province $province */
        $province = $this->provinceRepository->find($id);

        if(empty($province)) {
            return Response::json(ResponseUtil::makeError("Province not found"), 400);
        }

        return $this->sendResponse($province->toArray(), "Province retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdateProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/provinces/{id}",
     *      summary="Update the specified Province in storage",
     *      tags={"Province"},
     *      description="Update Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Province",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Province that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Province")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Province"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProvinceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Province $province */
        $province = $this->provinceRepository->find($id);

        if (empty($province)) {
            return Response::json(ResponseUtil::makeError("Province not found"), 400);
        }

        $province = $this->provinceRepository->update($input, $id);

        return $this->sendResponse($province->toArray(), "Province updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/provinces/{id}",
     *      summary="Remove the specified Province from storage",
     *      tags={"Province"},
     *      description="Delete Province",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Province",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Province $province */
        $province = $this->provinceRepository->find($id);

        if(empty($province)) {
            return Response::json(ResponseUtil::makeError("Province not found"), 400);
        }

        $province->delete();

        return $this->sendResponse($id, "Province deleted successfully");
    }
}
