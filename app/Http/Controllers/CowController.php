<?php

namespace App\Http\Controllers;

use App\Http\Requests\CowStoreRequest;
use App\Http\Resources\CowResource;
use App\Models\Cow;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;

class CowController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CowResource::collection(Cow::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CowStoreRequest $request)
    {
        try{
            $cow = Cow::create($request->validated());
            return $this->success('New cow added successfuly', new CowResource($cow), 201);
        }catch (\Exception $ex) {
            return $this->errorr('Failed to add new cow', $ex->getMessage());
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
