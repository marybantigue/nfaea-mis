<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInvoiceMemberRequest;
use App\Http\Requests\UpdateInvoiceMemberRequest;
use App\Repositories\InvoiceMemberRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InvoiceMemberController extends AppBaseController
{
    /** @var  InvoiceMemberRepository */
    private $invoiceMemberRepository;

    function __construct(InvoiceMemberRepository $invoiceMemberRepo)
    {
        $this->middleware('auth');
        $this->invoiceMemberRepository = $invoiceMemberRepo;
    }

    /**
     * Display a listing of the InvoiceMember.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->invoiceMemberRepository->pushCriteria(new RequestCriteria($request));
        $invoiceMembers = $this->invoiceMemberRepository->all();

        return view('invoiceMembers.index')
            ->with('invoiceMembers', $invoiceMembers);
    }

    /**
     * Show the form for creating a new InvoiceMember.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoiceMembers.create');
    }

    /**
     * Store a newly created InvoiceMember in storage.
     *
     * @param CreateInvoiceMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoiceMemberRequest $request)
    {
        $input = $request->all();

        $invoiceMember = $this->invoiceMemberRepository->create($input);

        Flash::success('InvoiceMember saved successfully.');

        return redirect(route('invoiceMembers.index'));
    }

    /**
     * Display the specified InvoiceMember.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoiceMember = $this->invoiceMemberRepository->findWithoutFail($id);

        if (empty($invoiceMember)) {
            Flash::error('InvoiceMember not found');

            return redirect(route('invoiceMembers.index'));
        }

        return view('invoiceMembers.show')->with('invoiceMember', $invoiceMember);
    }

    /**
     * Show the form for editing the specified InvoiceMember.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoiceMember = $this->invoiceMemberRepository->findWithoutFail($id);

        if (empty($invoiceMember)) {
            Flash::error('InvoiceMember not found');

            return redirect(route('invoiceMembers.index'));
        }

        return view('invoiceMembers.edit')->with('invoiceMember', $invoiceMember);
    }

    /**
     * Update the specified InvoiceMember in storage.
     *
     * @param  int              $id
     * @param UpdateInvoiceMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoiceMemberRequest $request)
    {
        $invoiceMember = $this->invoiceMemberRepository->findWithoutFail($id);

        if (empty($invoiceMember)) {
            Flash::error('InvoiceMember not found');

            return redirect(route('invoiceMembers.index'));
        }

        $invoiceMember = $this->invoiceMemberRepository->update($request->all(), $id);

        Flash::success('InvoiceMember updated successfully.');

        return redirect(route('invoiceMembers.index'));
    }

    /**
     * Remove the specified InvoiceMember from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoiceMember = $this->invoiceMemberRepository->findWithoutFail($id);

        if (empty($invoiceMember)) {
            Flash::error('InvoiceMember not found');

            return redirect(route('invoiceMembers.index'));
        }

        $this->invoiceMemberRepository->delete($id);

        Flash::success('InvoiceMember deleted successfully.');

        return redirect(route('invoiceMembers.index'));
    }
}
