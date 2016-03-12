<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createhelp_membersRequest;
use App\Http\Requests\Updatehelp_membersRequest;
use App\Repositories\help_membersRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class help_membersController extends AppBaseController
{
    /** @var  help_membersRepository */
    private $helpMembersRepository;

    function __construct(help_membersRepository $helpMembersRepo)
    {
        $this->middleware('auth');
        $this->helpMembersRepository = $helpMembersRepo;
    }

    /**
     * Display a listing of the help_members.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->helpMembersRepository->pushCriteria(new RequestCriteria($request));
        $helpMembers = $this->helpMembersRepository->all();

        return view('helpMembers.index')
            ->with('helpMembers', $helpMembers);
    }

    /**
     * Show the form for creating a new help_members.
     *
     * @return Response
     */
    public function create()
    {
        return view('helpMembers.create');
    }

    /**
     * Store a newly created help_members in storage.
     *
     * @param Createhelp_membersRequest $request
     *
     * @return Response
     */
    public function store(Createhelp_membersRequest $request)
    {
        $input = $request->all();

        $helpMembers = $this->helpMembersRepository->create($input);

        Flash::success('help_members saved successfully.');

        return redirect(route('helpMembers.index'));
    }

    /**
     * Display the specified help_members.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $helpMembers = $this->helpMembersRepository->findWithoutFail($id);

        if (empty($helpMembers)) {
            Flash::error('help_members not found');

            return redirect(route('helpMembers.index'));
        }

        return view('helpMembers.show')->with('helpMembers', $helpMembers);
    }

    /**
     * Show the form for editing the specified help_members.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $helpMembers = $this->helpMembersRepository->findWithoutFail($id);

        if (empty($helpMembers)) {
            Flash::error('help_members not found');

            return redirect(route('helpMembers.index'));
        }

        return view('helpMembers.edit')->with('helpMembers', $helpMembers);
    }

    /**
     * Update the specified help_members in storage.
     *
     * @param  int              $id
     * @param Updatehelp_membersRequest $request
     *
     * @return Response
     */
    public function update($id, Updatehelp_membersRequest $request)
    {
        $helpMembers = $this->helpMembersRepository->findWithoutFail($id);

        if (empty($helpMembers)) {
            Flash::error('help_members not found');

            return redirect(route('helpMembers.index'));
        }

        $helpMembers = $this->helpMembersRepository->update($request->all(), $id);

        Flash::success('help_members updated successfully.');

        return redirect(route('helpMembers.index'));
    }

    /**
     * Remove the specified help_members from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $helpMembers = $this->helpMembersRepository->findWithoutFail($id);

        if (empty($helpMembers)) {
            Flash::error('help_members not found');

            return redirect(route('helpMembers.index'));
        }

        $this->helpMembersRepository->delete($id);

        Flash::success('help_members deleted successfully.');

        return redirect(route('helpMembers.index'));
    }
}
