<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\VaccineStoreRequest;
use App\Http\Requests\VaccineUpdateRequest;
use App\Http\Resources\VaccineResource;
use App\Models\Vaccine;
use App\Services\VaccineService;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class VaccineController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VaccineService $vaccine_service)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);
        $vaccines = $vaccine_service->index($request);
        return VaccineResource::collection($vaccines);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VaccineStoreRequest $request, VaccineService $vaccine_service )
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
        )]);

        try{
            $vaccine =  $vaccine_service->store($request->validated());
            return $this->success('Vaccination Done successfuly', new VaccineResource($vaccine), 201);
        }catch (\Exception $ex) {
            return $this->error('Vaccination Failed', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        return $this->success('Vaccine retrieved successfully.', new VaccineResource($vaccine));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VaccineUpdateRequest $request, VaccineService $vaccine_service, Vaccine $vaccine)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $vaccine_service->update($request->validated(), $vaccine);
            return $this->success('Vaccine updated successfully', new VaccineResource($vaccine));
        }catch(\Exception $ex){
            return $this->error('Failed to update the vaccine', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try {
            $vaccine->delete();
            return $this->success('Vaccine deleted.', new VaccineResource($vaccine));
        } catch (\Exception $ex) {
            return $this->error('Failed to delete the vaccine', $ex->getMessage());
        }
    }
}
