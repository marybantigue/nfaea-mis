<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateprovinceRequest;
use App\Http\Requests\UpdateprovinceRequest;
use App\Repositories\provinceRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;


use Sentinel;
use Centaur\AuthManager;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;


class provinceController extends AppBaseController
{
    /** @var  provinceRepository */
    private $provinceRepository;

    function __construct(provinceRepository $provinceRepo)
    {
       // $this->middleware('auth');
        // Middleware
        $this->middleware('sentinel.auth');

        $this->middleware('sentinel.role:main');
        // Fetch the Role Repository from the IoC container
        //$this->roleRepository = app()->make('sentinel.roles');
        
        $this->provinceRepository = $provinceRepo;
    }

    /**
     * Display a listing of the province.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $this->provinceRepository->pushCriteria(new RequestCriteria($request));
        $provinces = $this->provinceRepository->paginate(10);

        return view('provinces.index')
            ->with('provinces', $provinces);
    }

    /**
     * Show the form for creating a new province.
     *
     * @return Response
     */
    public function create()
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        return view('provinces.create');
    }

    /**
     * Store a newly created province in storage.
     *
     * @param CreateprovinceRequest $request
     *
     * @return Response
     */
    public function store(CreateprovinceRequest $request)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $input = $request->all();

        $province = $this->provinceRepository->create($input);

        Flash::success('province saved successfully.');

        return redirect(route('provinces.index'));
    }

    /**
     * Display the specified province.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('province not found');

            return redirect(route('provinces.index'));
        }

        return view('provinces.show')->with('province', $province);
    }

    /**
     * Show the form for editing the specified province.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('province not found');

            return redirect(route('provinces.index'));
        }

        return view('provinces.edit')->with('province', $province);
    }

    /**
     * Update the specified province in storage.
     *
     * @param  int              $id
     * @param UpdateprovinceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovinceRequest $request)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('province not found');

            return redirect(route('provinces.index'));
        }

        $province = $this->provinceRepository->update($request->all(), $id);

        Flash::success('province updated successfully.');

        return redirect(route('provinces.index'));
    }

    /**
     * Remove the specified province from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(!Sentinel::inRole('main')){
           return redirect('dashboard');
        }
        $province = $this->provinceRepository->findWithoutFail($id);

        if (empty($province)) {
            Flash::error('province not found');

            return redirect(route('provinces.index'));
        }

        $this->provinceRepository->delete($id);

        Flash::success('province deleted successfully.');

        return redirect(route('provinces.index'));
    }
}
