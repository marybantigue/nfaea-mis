<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateinvoiceRequest;
use App\Http\Requests\UpdateinvoiceRequest;
use App\Repositories\invoiceRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use Gate;

use Mail;
use Sentinel;
use Centaur\AuthManager;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;


class invoiceController extends AppBaseController
{
    /** @var  invoiceRepository */
    private $invoiceRepository;

    function __construct(invoiceRepository $invoiceRepo)
    {
        //$this->middleware('auth');
        $this->invoiceRepository = $invoiceRepo;

        // Middleware
        $this->middleware('sentinel.auth');

        //$this->middleware('sentinel.role:subscriber');

        $this->middleware('sentinel.role:provincial');
        //$this->middleware('sentinel.role:main');
        // Fetch the Role Repository from the IoC container
        //$this->roleRepository = app()->make('sentinel.roles');


    }

    /**
     * Display a listing of the invoice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    $this->invoiceRepository->pushCriteria(new RequestCriteria($request));

        
        //if main
        if(Sentinel::inRole('main'))
            $invoices=  $this->invoiceRepository->invoicesProvinces();    
        //if province
        else if (Sentinel::inRole('provincial'))
           //return Sentinel::getUser();
           $invoices = $this->invoiceRepository->findByProvince(Sentinel::getUser()->province_id);
        

        return view('invoices.index')
            ->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new invoice.
     *
     * @return Response
     */
    public function create()
    {
        //return json_encode(Auth::user()->isMain());
        //$this->authorize('create');

        /*if (Gate::denies('create')) {
            dd("oops");
        }*/
        if(!Sentinel::inRole('main')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }

        $members = $this->invoiceRepository->membersNames();
        $members = $members->toArray();
        return view('invoices.create')->with(['members' => $members]);
    }

    /**
     * Store a newly created invoice in storage.
     *
     * @param CreateinvoiceRequest $request
     *
     * @return Response
     */
    public function store(CreateinvoiceRequest $request)
    {
        if(!Sentinel::inRole('main')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }
        $input = $request->all();
        //return $input['helpmember'];
        //create invoice
        $invoice = $this->invoiceRepository->create($input);
        //get provinces
        $provinces = $this->invoiceRepository->provinces();

        if($input['account_type']=="HELP"){
            //store the members that needs help
            $this->insertHelpMembers($invoice->id, $input['helpmember']);
        }
        //send invoice to provinces
        $this->insertInvoiceProvince($invoice->id);
        
        Flash::success('Invoices sent to provinces successfully.');

        return redirect(route('invoices.index'));
    }

    /**
     * Display the specified invoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        $invoice = $this->invoiceRepository->findWithoutFail($id);

        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }

        return view('invoices.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified invoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(!Sentinel::inRole('main')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }

        $members = $this->invoiceRepository->membersNames();
        $invoice = $this->invoiceRepository->findWithoutFail($id);

        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }

        return view('invoices.edit')->with('invoice', $invoice)->with(['members' => $members]);
    }

    /**
     * Update the specified invoice in storage.
     *
     * @param  int              $id
     * @param UpdateinvoiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinvoiceRequest $request)
    {
        if(!Sentinel::inRole('main')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }
        $invoice = $this->invoiceRepository->findWithoutFail($id);
        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }

        $invoice = $this->invoiceRepository->update($request->all(), $id);

        Flash::success('invoice updated successfully.');

        return redirect(route('invoices.index'));
    }

    /**
     * Remove the specified invoice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(!Sentinel::inRole('main')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }
        $invoice = $this->invoiceRepository->findWithoutFail($id);

        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }

        $this->invoiceRepository->delete($id);

        Flash::success('invoice deleted successfully.');

        return redirect(route('invoices.index'));
    }


    //insert to help_members
    private function insertHelpMembers($id, $helpmembers)
    {   
        
        $invoice =$this->invoiceRepository->findWithoutFail($id);
        foreach($helpmembers as $member):
            $invoice->helpMembers()->attach($member['member_id'], [ 'amount'=> $member['amount']]);
        endforeach;
        
    }
    private function insertInvoiceProvince($id)
    {
        $invoice =$this->invoiceRepository->findWithoutFail($id);
        $provinces = $this->invoiceRepository->provinces();
  
        foreach($provinces as $province_id => $province_name) {
            //insert to invoice_province
            $invoice->province()->attach($province_id, ['status' => 'Sent to Province']);
            $members = $this->invoiceRepository->provinceMembers($province_id);
            
            //insert to invoice_members
            foreach($members as $member):
                $invoice->members()->attach($member->id, ['paid'=>'0']);
            endforeach; 
        }
    }
    
    public function editFromProvince($id, $province_id)
    {

        if(!Sentinel::inRole('provincial')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }
        /*$invoice =  $this->invoiceRepository->findInvoiceFromPivot($id, $province_id);*/
        


        $invoice = $this->invoiceRepository->invoiceWithProvince($id, $province_id);

        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }

        $help_members =  $invoice->helpMembers()->paginate(6);
        //$members = $this->invoiceRepository->provinceMembers($province_id)->paginate(10);

        $members = $invoice->members()->where('province_id', '=', $province_id)->paginate(10);

        //return $members;
        return view('invoices.editFromProvince')
            ->with(['invoice' => $invoice,
                    'members' => $members,
                    'help_members' => $help_members]);
    }

    public function updateFromProvince($id, $province_id, UpdateinvoiceRequest $request)
    {
        if(!Sentinel::inRole('provincial')){
             //Flash::error('invoice not found');
            return redirect('invoices');
            //return;
        }
        $invoice =  $this->invoiceRepository->findInvoiceFromPivot($id, $province_id);
       
       //$invoice = $this->invoiceRepository->findWithoutFail($id);
       //return $request->invoiceMember;
        if (empty($invoice)) {
            Flash::error('invoice not found');

            return redirect(route('invoices.index'));
        }
        //$invoice->push($request);
//        return $request->remarks;
        if($request->remarks != ""){
            //$province = $invoice->province->find(Auth::user()->province_id);
            $invoice->province->first()->pivot->update(['remarks' => $request->remarks, 'status' => 'Done']);
            
        }
        foreach($request->invoiceMember as $index => $value) {
              $invoice->members->find($index)->pivot->update(array('paid' => $value['paid']));
           
        }
//        $invoice = $this->invoiceRepository->updateFromProvince($request->all(), $id);

        Flash::success('invoice updated successfully.');

        return redirect(route('invoices.index'));
    }

}
