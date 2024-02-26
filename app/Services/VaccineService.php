<?php
namespace App\Services;

use App\Models\Vaccine;
use App\Traits\Search;
use Illuminate\Support\Facades\DB;

class VaccineService{

    use Search;

    public function index($data)
    {
        $vaccines =  $this->search(Vaccine::class, $data)
        ->when($data->cow, function($query) use($data){
            $query->whereHas('cows', function($query) use($data) {
                $query->where('ear_tag_no', $data->cow);
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

    public function update($data, $vaccine){
        DB::transaction(function () use($data, $vaccine) {
            $vaccine->cows()->sync($data['cows']);
            $vaccine->update($data);
            $vaccine->save();
        }, 5);
    }
}
