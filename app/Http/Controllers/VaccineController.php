<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\VaccineStoreRequest;
use App\Http\Resources\VaccineResource;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class VaccineController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);
        $vaccines = Vaccine::paginate();
        return VaccineResource::collection($vaccines);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VaccineStoreRequest $request)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
        )]);

        try{
            $vaccine = Vaccine::create($request->validated());
            $vaccine->cows()->sync($request->get('cows'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaccine $vaccine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        //
    }
}
