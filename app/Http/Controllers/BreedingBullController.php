<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\BreedingBullStoreRequest;
use App\Http\Requests\BreedingBullUpdateRequest;
use App\Http\Resources\BreedingBullResource;
use App\Models\BreedingBull;
use App\Services\BreedingBullService;
use App\Traits\HttpResponse;
use App\Traits\Search;
use Illuminate\Http\Request;

class BreedingBullController extends Controller
{
    use HttpResponse, Search;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BreedingBullService $breeding_bull_service)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        return $breeding_bull_service->index($request);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(BreedingBullStoreRequest $request, BreedingBullService $breeding_bull_service)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $breeding_bull = $breeding_bull_service->store($request->validated());
            return $this->success('New Breeding Bull added successfuly', new BreedingBullResource($breeding_bull), 201);
        }catch (\Exception $ex) {
            return $this->error('Failed to add new Breeding Bull', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BreedingBull $breeding_bull)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        return $this->success('Breeding Bull retrieved successfully.', new BreedingBullResource($breeding_bull));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BreedingBullUpdateRequest $request, BreedingBullService $breeding_bull_service, BreedingBull $breeding_bull)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $breeding_bull_service->update($request->validated(), $breeding_bull);
            return $this->success('Breeding Bull updated successfully.', new BreedingBullResource($breeding_bull));
        }catch (\Exception $ex) {
            return $this->error('Failed to update the Breeding Bull', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BreedingBull $breeding_bull)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try {
            $breeding_bull->delete();
            return $this->success('Breeding Bull deleted.', new BreedingBullResource($breeding_bull));
        } catch (\Exception $ex) {
            return $this->error('Failed to delete the Breeding Bull', $ex->getMessage());
        }
    }
}
