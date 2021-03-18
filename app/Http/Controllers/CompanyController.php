<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Http\Resources\Company\CompanyCollection;
use App\Http\Resources\Company\CompanyResource;
use App\Managers\CompanyManager;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CompanyCollection
     */
    public function index(Request $request)
    {
        $companies = Company::query()
            ->with('ratings')
            ->paginate($request->get('per_page', 10));

        return new CompanyCollection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param CompanyManager $manager
     * @return JsonResponse
     */
    public function store(StoreRequest $request, CompanyManager $manager)
    {
        $data = $request->validated();

        $manager->createCompany($data);

        return response()
            ->json([
                'message' => 'Company successfully created',
                'data' => $manager->getCompanyResource()
            ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company)
    {
        return response()
            ->json([
                'data' => new CompanyResource($company)
            ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Company $company
     * @param CompanyManager $manager
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function update(UpdateRequest $request, Company $company, CompanyManager $manager)
    {
        $data = $request->validated();

        $manager->updateCompany($data, $company);

        return response([
            'message' => 'Company successfully updated',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param CompanyManager $manager
     * @return void
     * @throws \Exception
     */
    public function destroy(Company $company, CompanyManager $manager)
    {
        if(!Auth::check() || !Auth::user()->is_admin) {
            throw new UnauthorizedHttpException('Only admin users may delete companies');
        }

        $manager->deleteCompany($company);
    }
}
