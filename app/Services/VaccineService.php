<?php
namespace App\Services;

use App\Http\Resources\VaccineResourceSimple;
use App\Models\Cow;
use App\Models\Vaccine;
use App\Traits\Search;
use Illuminate\Support\Facades\DB;

class VaccineService{

    use Search;

    public function index($data)
    {
        $vaccines =  $this->search(Vaccine::class, $data)
        ->when($data->cow, function($query) use($data){
            return Cow::where('id', $data->cow)->first()->vaccines();
        })
        ->when($data->vaccine_type, function($query) use($data){
            $query->where('vaccine_type', '=', $data->vaccine_type);
        })->paginate();

        return $vaccines;
    }

    public function store($data)
    {
        $vaccine = Vaccine::create($data);
        $vaccine->cows()->sync($data['cows']);
        return $vaccine;
    }
}
