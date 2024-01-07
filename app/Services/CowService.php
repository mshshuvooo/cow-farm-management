<?php
namespace App\Services;

use App\Http\Resources\CowResource;
use App\Http\Resources\CowResourceSimple;
use App\Models\Cow;
use App\Traits\Search;

class CowService
{
    use Search;

    /**
     * Display cow listing
    **/
    public function index($data)
    {

        if ($data->display == 'simple') {
            $cows =  $this->search(Cow::class, $data)
            ->when($data->gender, function($query) use($data){
                $query->where('gender', '=', $data->gender);
            })
            ->when($data->status, function($query) use($data){
                $query->where('status', '=', $data->status);
            })->get();

            return CowResourceSimple::collection($cows);
        }

        $cows =  $this->search(Cow::class,$data)
        ->when($data->gender, function($query) use($data){
            $query->where('gender', '=', $data->gender);
        })
        ->when($data->status, function($query) use($data){
            $query->where('status', '=', $data->status);
        })->paginate();

        return CowResource::collection($cows);
    }

    /**
     * Store a new cow
    **/
    public function store($data)
    {
        return Cow::create($data);
    }


    public function update($data, $cow)
    {
        $cow->update($data);
        $cow->save();
    }
}
