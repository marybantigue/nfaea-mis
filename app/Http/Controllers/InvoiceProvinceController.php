<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInvoiceProvinceRequest;
use App\Http\Requests\UpdateInvoiceProvinceRequest;
use App\Repositories\InvoiceProvinceRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InvoiceProvinceController extends AppBaseController
{
    /** @var  InvoiceProvinceRepository */
    private $invoiceProvinceRepository;

    function __construct(InvoiceProvinceRepository $invoiceProvinceRepo)
    {
        $this->middleware('auth');
        $this->invoiceProvinceRepository = $invoiceProvinceRepo;
    }

    /**
     * Display a listing of the InvoiceProvince.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->invoiceProvinceRepository->pushCriteria(new RequestCriteria($request));
        $invoiceProvinces = $this->invoiceProvinceRepository->all();

        return view('invoiceProvinces.index')
            ->with('invoiceProvinces', $invoiceProvinces);
    }

    /**
     * Show the form for creating a new InvoiceProvince.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoiceProvinces.create');
    }

    /**
     * Store a newly created InvoiceProvince in storage.
     *
     * @param CreateInvoiceProvinceRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoiceProvinceRequest $request)
    {
        $input = $request->all();

        $invoiceProvince = $this->invoiceProvinceRepository->create($input);

        Flash::success('InvoiceProvince saved successfully.');

        return redirect(route('invoiceProvinces.index'));
    }

    /**
     * Display the specified InvoiceProvince.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoiceProvince = $this->invoiceProvinceRepository->findWithoutFail($id);

        if (empty($invoiceProvince)) {
            Flash::error('InvoiceProvince not found');

            return redirect(route('invoiceProvinces.index'));
        }

        return view('invoiceProvinces.show')->with('invoiceProvince', $invoiceProvince);
    }

    /**
     * Show the form for editing the specified InvoiceProvince.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoiceProvince = $this->invoiceProvinceRepository->findWithoutFail($id);

        if (empty($invoiceProvince)) {
            Flash::error('InvoiceProvince not found');

            return redirect(route('invoiceProvinces.index'));
        }

        return view('invoiceProvinces.edit')->with('invoiceProvince', $invoiceProvince);
    }

    /**
     * Update the specified InvoiceProvince in storage.
     *
     * @param  int              $id
     * @param UpdateInvoiceProvinceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoiceProvinceRequest $request)
    {
        $invoiceProvince = $this->invoiceProvinceRepository->findWithoutFail($id);

        if (empty($invoiceProvince)) {
            Flash::error('InvoiceProvince not found');

            return redirect(route('invoiceProvinces.index'));
        }

        $invoiceProvince = $this->invoiceProvinceRepository->update($request->all(), $id);

        Flash::success('InvoiceProvince updated successfully.');

        return redirect(route('invoiceProvinces.index'));
    }

    /**
     * Remove the specified InvoiceProvince from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoiceProvince = $this->invoiceProvinceRepository->findWithoutFail($id);

        if (empty($invoiceProvince)) {
            Flash::error('InvoiceProvince not found');

            return redirect(route('invoiceProvinces.index'));
        }

        $this->invoiceProvinceRepository->delete($id);

        Flash::success('InvoiceProvince deleted successfully.');

        return redirect(route('invoiceProvinces.index'));
    }
}
