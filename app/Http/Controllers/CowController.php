<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\CowStoreRequest;
use App\Http\Requests\CowUpdateRequest;
use App\Http\Resources\CowResourceSimple;
use App\Http\Resources\CowResource;
use App\Models\Cow;
use App\Services\CowService;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Traits\Search;

class CowController extends Controller
{
    use HttpResponse, Search;
    /**
     *
     * Display a listing of the resource.
     */
    public function index(Request $request, CowService $cow_service)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        return $cow_service->index($request);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CowStoreRequest $request, CowService $cow_service)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $cow = $cow_service->store($request->validated());
            return $this->success('New cow added successfuly', new CowResource($cow), 201);
        }catch (\Exception $ex) {
            return $this->error('Failed to add new cow', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cow $cow)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        return $this->success('Cow retrieved successfully.', new CowResource($cow));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CowUpdateRequest $request, CowService $cow_service, Cow $cow)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $cow_service->update($request->validated(), $cow);
            return $this->success('Cow updated successfully.', new CowResource($cow));
        }catch (\Exception $ex) {
            return $this->error('Failed to update the cow', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
