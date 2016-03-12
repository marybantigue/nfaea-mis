<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinvoiceAPIRequest;
use App\Http\Requests\API\UpdateinvoiceAPIRequest;
use App\Models\invoice;
use App\Repositories\invoiceRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class invoiceController
 * @package App\Http\Controllers\API
 */

class invoiceAPIController extends AppBaseController
{
    /** @var  invoiceRepository */
    private $invoiceRepository;

    function __construct(invoiceRepository $invoiceRepo)
    {
        $this->invoiceRepository = $invoiceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoices",
     *      summary="Get a listing of the invoices.",
     *      tags={"invoice"},
     *      description="Get all invoices",
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
     *                  @SWG\Items(ref="#/definitions/invoice")
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
        $this->invoiceRepository->pushCriteria(new RequestCriteria($request));
        $this->invoiceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $invoices = $this->invoiceRepository->all();

        return $this->sendResponse($invoices->toArray(), "invoices retrieved successfully");
    }

    /**
     * @param CreateinvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/invoices",
     *      summary="Store a newly created invoice in storage",
     *      tags={"invoice"},
     *      description="Store invoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="invoice that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/invoice")
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
     *                  ref="#/definitions/invoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateinvoiceAPIRequest $request)
    {
        $input = $request->all();

        $invoices = $this->invoiceRepository->create($input);

        return $this->sendResponse($invoices->toArray(), "invoice saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoices/{id}",
     *      summary="Display the specified invoice",
     *      tags={"invoice"},
     *      description="Get invoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of invoice",
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
     *                  ref="#/definitions/invoice"
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
        /** @var invoice $invoice */
        $invoice = $this->invoiceRepository->find($id);

        if(empty($invoice)) {
            return Response::json(ResponseUtil::makeError("invoice not found"), 400);
        }

        return $this->sendResponse($invoice->toArray(), "invoice retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdateinvoiceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/invoices/{id}",
     *      summary="Update the specified invoice in storage",
     *      tags={"invoice"},
     *      description="Update invoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of invoice",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="invoice that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/invoice")
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
     *                  ref="#/definitions/invoice"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateinvoiceAPIRequest $request)
    {
        $input = $request->all();

        /** @var invoice $invoice */
        $invoice = $this->invoiceRepository->find($id);

        if (empty($invoice)) {
            return Response::json(ResponseUtil::makeError("invoice not found"), 400);
        }

        $invoice = $this->invoiceRepository->update($input, $id);

        return $this->sendResponse($invoice->toArray(), "invoice updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/invoices/{id}",
     *      summary="Remove the specified invoice from storage",
     *      tags={"invoice"},
     *      description="Delete invoice",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of invoice",
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
        /** @var invoice $invoice */
        $invoice = $this->invoiceRepository->find($id);

        if(empty($invoice)) {
            return Response::json(ResponseUtil::makeError("invoice not found"), 400);
        }

        $invoice->delete();

        return $this->sendResponse($id, "invoice deleted successfully");
    }
}
