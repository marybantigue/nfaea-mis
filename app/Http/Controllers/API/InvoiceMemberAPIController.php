<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInvoiceMemberAPIRequest;
use App\Http\Requests\API\UpdateInvoiceMemberAPIRequest;
use App\Models\InvoiceMember;
use App\Repositories\InvoiceMemberRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InvoiceMemberController
 * @package App\Http\Controllers\API
 */

class InvoiceMemberAPIController extends AppBaseController
{
    /** @var  InvoiceMemberRepository */
    private $invoiceMemberRepository;

    function __construct(InvoiceMemberRepository $invoiceMemberRepo)
    {
        $this->invoiceMemberRepository = $invoiceMemberRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoiceMembers",
     *      summary="Get a listing of the InvoiceMembers.",
     *      tags={"InvoiceMember"},
     *      description="Get all InvoiceMembers",
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
     *                  @SWG\Items(ref="#/definitions/InvoiceMember")
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
        $this->invoiceMemberRepository->pushCriteria(new RequestCriteria($request));
        $this->invoiceMemberRepository->pushCriteria(new LimitOffsetCriteria($request));
        $invoiceMembers = $this->invoiceMemberRepository->all();

        return $this->sendResponse($invoiceMembers->toArray(), "InvoiceMembers retrieved successfully");
    }

    /**
     * @param CreateInvoiceMemberAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/invoiceMembers",
     *      summary="Store a newly created InvoiceMember in storage",
     *      tags={"InvoiceMember"},
     *      description="Store InvoiceMember",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InvoiceMember that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InvoiceMember")
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
     *                  ref="#/definitions/InvoiceMember"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInvoiceMemberAPIRequest $request)
    {
        $input = $request->all();

        $invoiceMembers = $this->invoiceMemberRepository->create($input);

        return $this->sendResponse($invoiceMembers->toArray(), "InvoiceMember saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/invoiceMembers/{id}",
     *      summary="Display the specified InvoiceMember",
     *      tags={"InvoiceMember"},
     *      description="Get InvoiceMember",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceMember",
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
     *                  ref="#/definitions/InvoiceMember"
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
        /** @var InvoiceMember $invoiceMember */
        $invoiceMember = $this->invoiceMemberRepository->find($id);

        if(empty($invoiceMember)) {
            return Response::json(ResponseUtil::makeError("InvoiceMember not found"), 400);
        }

        return $this->sendResponse($invoiceMember->toArray(), "InvoiceMember retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdateInvoiceMemberAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/invoiceMembers/{id}",
     *      summary="Update the specified InvoiceMember in storage",
     *      tags={"InvoiceMember"},
     *      description="Update InvoiceMember",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceMember",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="InvoiceMember that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/InvoiceMember")
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
     *                  ref="#/definitions/InvoiceMember"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInvoiceMemberAPIRequest $request)
    {
        $input = $request->all();

        /** @var InvoiceMember $invoiceMember */
        $invoiceMember = $this->invoiceMemberRepository->find($id);

        if (empty($invoiceMember)) {
            return Response::json(ResponseUtil::makeError("InvoiceMember not found"), 400);
        }

        $invoiceMember = $this->invoiceMemberRepository->update($input, $id);

        return $this->sendResponse($invoiceMember->toArray(), "InvoiceMember updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/invoiceMembers/{id}",
     *      summary="Remove the specified InvoiceMember from storage",
     *      tags={"InvoiceMember"},
     *      description="Delete InvoiceMember",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InvoiceMember",
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
        /** @var InvoiceMember $invoiceMember */
        $invoiceMember = $this->invoiceMemberRepository->find($id);

        if(empty($invoiceMember)) {
            return Response::json(ResponseUtil::makeError("InvoiceMember not found"), 400);
        }

        $invoiceMember->delete();

        return $this->sendResponse($id, "InvoiceMember deleted successfully");
    }
}
