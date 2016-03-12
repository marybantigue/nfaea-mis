<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createhelp_membersAPIRequest;
use App\Http\Requests\API\Updatehelp_membersAPIRequest;
use App\Models\help_members;
use App\Repositories\help_membersRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class help_membersController
 * @package App\Http\Controllers\API
 */

class help_membersAPIController extends AppBaseController
{
    /** @var  help_membersRepository */
    private $helpMembersRepository;

    function __construct(help_membersRepository $helpMembersRepo)
    {
        $this->helpMembersRepository = $helpMembersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/helpMembers",
     *      summary="Get a listing of the help_members.",
     *      tags={"help_members"},
     *      description="Get all help_members",
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
     *                  @SWG\Items(ref="#/definitions/help_members")
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
        $this->helpMembersRepository->pushCriteria(new RequestCriteria($request));
        $this->helpMembersRepository->pushCriteria(new LimitOffsetCriteria($request));
        $helpMembers = $this->helpMembersRepository->all();

        return $this->sendResponse($helpMembers->toArray(), "help_members retrieved successfully");
    }

    /**
     * @param Createhelp_membersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/helpMembers",
     *      summary="Store a newly created help_members in storage",
     *      tags={"help_members"},
     *      description="Store help_members",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="help_members that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/help_members")
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
     *                  ref="#/definitions/help_members"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createhelp_membersAPIRequest $request)
    {
        $input = $request->all();

        $helpMembers = $this->helpMembersRepository->create($input);

        return $this->sendResponse($helpMembers->toArray(), "help_members saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/helpMembers/{id}",
     *      summary="Display the specified help_members",
     *      tags={"help_members"},
     *      description="Get help_members",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of help_members",
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
     *                  ref="#/definitions/help_members"
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
        /** @var help_members $helpMembers */
        $helpMembers = $this->helpMembersRepository->find($id);

        if(empty($helpMembers)) {
            return Response::json(ResponseUtil::makeError("help_members not found"), 400);
        }

        return $this->sendResponse($helpMembers->toArray(), "help_members retrieved successfully");
    }

    /**
     * @param int $id
     * @param Updatehelp_membersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/helpMembers/{id}",
     *      summary="Update the specified help_members in storage",
     *      tags={"help_members"},
     *      description="Update help_members",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of help_members",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="help_members that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/help_members")
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
     *                  ref="#/definitions/help_members"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatehelp_membersAPIRequest $request)
    {
        $input = $request->all();

        /** @var help_members $helpMembers */
        $helpMembers = $this->helpMembersRepository->find($id);

        if (empty($helpMembers)) {
            return Response::json(ResponseUtil::makeError("help_members not found"), 400);
        }

        $helpMembers = $this->helpMembersRepository->update($input, $id);

        return $this->sendResponse($helpMembers->toArray(), "help_members updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/helpMembers/{id}",
     *      summary="Remove the specified help_members from storage",
     *      tags={"help_members"},
     *      description="Delete help_members",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of help_members",
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
        /** @var help_members $helpMembers */
        $helpMembers = $this->helpMembersRepository->find($id);

        if(empty($helpMembers)) {
            return Response::json(ResponseUtil::makeError("help_members not found"), 400);
        }

        $helpMembers->delete();

        return $this->sendResponse($id, "help_members deleted successfully");
    }
}
