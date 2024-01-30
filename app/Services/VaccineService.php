<?php
namespace App\Services;

use App\Http\Resources\VaccineResourceSimple;
use App\Models\Cow;
use App\Models\Vaccine;
use App\Traits\Search;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
            // $cows = array_values(explode(",",$data->cows));
            // //var_dump($cows);
            // $query->whereHas('cows', function($query) use($data, $cows) {
            //     $query->whereIn('id', $cows);
            // });


        })->paginate();

            // $vaccines = DB::table('vaccines')
            // ->whereExists(function ($query) {
            // $query
            // ->where('id', '=', 1);
            // })->paginate();

            // $vaccines = DB::table('vaccines')
            // ->whereExists(function (Builder $query) {
            //     $query->select(DB::raw(1))
            //           ->from('cows')
            //           ->whereColumn('id', 1);
            // })
            // ->get();

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
