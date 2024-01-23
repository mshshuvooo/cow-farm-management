<?php
namespace App\Services;

use App\Http\Resources\VaccineResourceSimple;
use App\Models\Cow;
use App\Models\Vaccine;
use App\Traits\Search;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VaccineService{

    use Search;

    public function index($data)
    {
        $vaccines =  $this->search(Vaccine::class, $data)
        ->when($data->cow, function($query) use($data){
            $query->whereHas('cows', function($query) use($data) {
                $query->where('id', $data->cow);
            });
        })
        ->when($data->vaccine_type, function($query) use($data){
            $query->where('vaccine_type', '=', $data->vaccine_type);
        })->paginate();

        return $vaccines;
    }

    public function store($data)
    {
        return(
            DB::transaction(function () use($data) {
                $vaccine = Vaccine::create($data);
                $vaccine->cows()->sync($data['cows']);
                return $vaccine;
            }, 5)
        );

    }
}
