<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Sentinel;
use Centaur\AuthManager;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    function __construct(MemberRepository $memberRepo)
    {
        // $this->middleware('auth');
        // Middleware
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.role:main');
        // Fetch the Role Repository from the IoC container
        $this->roleRepository = app()->make('sentinel.roles');
        
        $this->memberRepository = $memberRepo;
    }

    /**
     * Display a listing of the Member.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->memberRepository->pushCriteria(new RequestCriteria($request));
        $members = $this->memberRepository->paginate(10);

        return view('members.index')
            ->with('members', $members);
    }

    /**
     * Show the form for creating a new Member.
     *
     * @return Response
     */
    public function create()
    {
        $provinces = $this->memberRepository->provinces();
        return view('members.create')->with(['provinces' => $provinces]);
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param CreateMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberRequest $request)
    {
        $input = $request->all();

        $member = $this->memberRepository->create($input);

        Flash::success('Member saved successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Display the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $member = $this->memberRepository->findWithoutFail($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('members.show')->with('member', $member);
    }

    /**
     * Show the form for editing the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = $this->memberRepository->findWithoutFail($id);
        $provinces = $this->memberRepository->provinces();

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('members.edit')->with(['member' => $member, 'provinces' => $provinces]);
    }

    /**
     * Update the specified Member in storage.
     *
     * @param  int              $id
     * @param UpdateMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberRequest $request)
    {
        //return $request;
        $member = $this->memberRepository->findWithoutFail($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $member = $this->memberRepository->update($request->all(), $id);

        Flash::success('Member updated successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Remove the specified Member from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $member = $this->memberRepository->findWithoutFail($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $this->memberRepository->delete($id);

        Flash::success('Member deleted successfully.');

        return redirect(route('members.index'));
    }

   

}
