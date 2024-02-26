<?php
namespace App\Services;

use App\Http\Resources\BreedingBullResource;
use App\Http\Resources\CowResource;
use App\Http\Resources\CowResourceSimple;
use App\Models\BreedingBull;
use App\Models\Cow;
use App\Models\Vaccine;
use App\Traits\Search;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BreedingBullService
{
    use Search;

    public function index($data)
    {

        if ($data->display == 'simple') {
            $breeding_bulls =  $this->search(BreedingBull::class, $data)
            ->get();

            return BreedingBullResource::collection($breeding_bulls);
        }

        $breeding_bulls =  $this->search(BreedingBull::class,$data)
        ->when($data->bull_owner, function($query) use($data){
            $query->where('bull_owner', '=', $data->bull_owner);
        })
        ->when($data->bull_breed, function($query) use($data){
            $query->where('bull_breed', '=', $data->bull_breed);
        })
        ->paginate();

        return BreedingBullResource::collection($breeding_bulls);
    }

    public function store($data)
    {
        return BreedingBull::create($data);
    }

    public function update($data, $breeding_bull)
    {
        $breeding_bull->update($data);
        $breeding_bull->save();
    }
}
