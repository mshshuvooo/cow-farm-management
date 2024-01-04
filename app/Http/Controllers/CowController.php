<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\CowStoreRequest;
use App\Http\Resources\CowResourceSimple;
use App\Http\Resources\CowResource;
use App\Models\Cow;
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
    public function index(Request $request)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value,
            UserRoleEnum::SUBSCRIBER->value
        )]);

        if ($request->display == 'simple') {
            $cows = Cow::all();

            return CowResourceSimple::collection($cows);
        }

        $cows =  $this->search(Cow::class,$request)
        ->when($request->gender, function($query) use($request){
            $query->where('gender', '=', $request->gender);
        })
        ->when($request->status, function($query) use($request){
            $query->where('status', '=', $request->status);
        })
        ->paginate();
        return CowResource::collection($cows);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CowStoreRequest $request)
    {
        $this->authorize('validate-role', [array(
            UserRoleEnum::ADMIN->value
        )]);

        try{
            $cow = Cow::create($request->validated());
            return $this->success('New cow added successfuly', new CowResource($cow), 201);
        }catch (\Exception $ex) {
            return $this->error('Failed to add new cow', $ex->getMessage());
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
