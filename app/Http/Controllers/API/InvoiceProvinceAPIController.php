<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInvoiceProvinceAPIRequest;
use App\Http\Requests\API\UpdateInvoiceProvinceAPIRequest;
use App\Models\InvoiceProvince;
use App\Repositories\InvoiceProvinceRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InvoiceProvinceController
 * @package App\Http\Controllers\API
 */

class InvoiceProvinceAPIController extends AppBaseController
{
    /** @var  InvoiceProvinceRepository */
    private $invoiceProvinceRepository;

    function __construct(InvoiceProvinceRepository $invoiceProvinceRepo)
    {
        $this->invoiceProvinceRepository = $invoiceProvinceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoiceProvinces",
     *      summary="Get a listing of the InvoiceProvinces.",
     *      tags={"InvoiceProvince"},
     *      description="Get all InvoiceProvinces",
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
     *                  @SWG\Items(ref="#/definitions/InvoiceProvince")
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
        $this->invoiceProvinceRepository->pushCriteria(new RequestCriteria($request));
        $this->invoiceProvinceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $invoiceProvinces = $this->invoiceProvinceRepository->all();

        return $this->sendResponse($invoiceProvinces->toArray(), "InvoiceProvinces retrieved successfully");
    }

    /**
     * @param CreateInvoiceProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/invoiceProvinces",
     *      summary="Store a newly created InvoiceProvince in storage",
     *      tags={"InvoiceProvince"},
     *      description="Store InvoiceProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InvoiceProvince that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InvoiceProvince")
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
     *                  ref="#/definitions/InvoiceProvince"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInvoiceProvinceAPIRequest $request)
    {
        $input = $request->all();

        $invoiceProvinces = $this->invoiceProvinceRepository->create($input);

        return $this->sendResponse($invoiceProvinces->toArray(), "InvoiceProvince saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoiceProvinces/{id}",
     *      summary="Display the specified InvoiceProvince",
     *      tags={"InvoiceProvince"},
     *      description="Get InvoiceProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceProvince",
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
     *                  ref="#/definitions/InvoiceProvince"
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
        /** @var InvoiceProvince $invoiceProvince */
        $invoiceProvince = $this->invoiceProvinceRepository->find($id);

        if(empty($invoiceProvince)) {
            return Response::json(ResponseUtil::makeError("InvoiceProvince not found"), 400);
        }

        return $this->sendResponse($invoiceProvince->toArray(), "InvoiceProvince retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdateInvoiceProvinceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/invoiceProvinces/{id}",
     *      summary="Update the specified InvoiceProvince in storage",
     *      tags={"InvoiceProvince"},
     *      description="Update InvoiceProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceProvince",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InvoiceProvince that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InvoiceProvince")
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
     *                  ref="#/definitions/InvoiceProvince"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInvoiceProvinceAPIRequest $request)
    {
        $input = $request->all();

        /** @var InvoiceProvince $invoiceProvince */
        $invoiceProvince = $this->invoiceProvinceRepository->find($id);

        if (empty($invoiceProvince)) {
            return Response::json(ResponseUtil::makeError("InvoiceProvince not found"), 400);
        }

        $invoiceProvince = $this->invoiceProvinceRepository->update($input, $id);

        return $this->sendResponse($invoiceProvince->toArray(), "InvoiceProvince updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/invoiceProvinces/{id}",
     *      summary="Remove the specified InvoiceProvince from storage",
     *      tags={"InvoiceProvince"},
     *      description="Delete InvoiceProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceProvince",
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
        /** @var InvoiceProvince $invoiceProvince */
        $invoiceProvince = $this->invoiceProvinceRepository->find($id);

        if(empty($invoiceProvince)) {
            return Response::json(ResponseUtil::makeError("InvoiceProvince not found"), 400);
        }

        $invoiceProvince->delete();

        return $this->sendResponse($id, "InvoiceProvince deleted successfully");
    }
}
