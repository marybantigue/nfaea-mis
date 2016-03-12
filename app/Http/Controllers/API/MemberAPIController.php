<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMemberAPIRequest;
use App\Http\Requests\API\UpdateMemberAPIRequest;
use App\Models\Member;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MemberController
 * @package App\Http\Controllers\API
 */

class MemberAPIController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/members",
     *      summary="Get a listing of the Members.",
     *      tags={"Member"},
     *      description="Get all Members",
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
     *                  @SWG\Items(ref="#/definitions/Member")
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
        $this->memberRepository->pushCriteria(new RequestCriteria($request));
        $this->memberRepository->pushCriteria(new LimitOffsetCriteria($request));
        $members = $this->memberRepository->all();

        return $this->sendResponse($members->toArray(), "Members retrieved successfully");
    }

    /**
     * @param CreateMemberAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/members",
     *      summary="Store a newly created Member in storage",
     *      tags={"Member"},
     *      description="Store Member",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Member that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Member")
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
     *                  ref="#/definitions/Member"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMemberAPIRequest $request)
    {
        $input = $request->all();

        $members = $this->memberRepository->create($input);

        return $this->sendResponse($members->toArray(), "Member saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/members/{id}",
     *      summary="Display the specified Member",
     *      tags={"Member"},
     *      description="Get Member",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member",
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
     *                  ref="#/definitions/Member"
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
        /** @var Member $member */
        $member = $this->memberRepository->find($id);

        if(empty($member)) {
            return Response::json(ResponseUtil::makeError("Member not found"), 400);
        }

        return $this->sendResponse($member->toArray(), "Member retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdateMemberAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/members/{id}",
     *      summary="Update the specified Member in storage",
     *      tags={"Member"},
     *      description="Update Member",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Member that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Member")
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
     *                  ref="#/definitions/Member"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMemberAPIRequest $request)
    {
        $input = $request->all();

        /** @var Member $member */
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            return Response::json(ResponseUtil::makeError("Member not found"), 400);
        }

        $member = $this->memberRepository->update($input, $id);

        return $this->sendResponse($member->toArray(), "Member updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/members/{id}",
     *      summary="Remove the specified Member from storage",
     *      tags={"Member"},
     *      description="Delete Member",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Member",
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
        /** @var Member $member */
        $member = $this->memberRepository->find($id);

        if(empty($member)) {
            return Response::json(ResponseUtil::makeError("Member not found"), 400);
        }

        $member->delete();

        return $this->sendResponse($id, "Member deleted successfully");
    }
}
