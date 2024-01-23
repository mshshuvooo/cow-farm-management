<?php
namespace App\Services;

use App\Http\Resources\CowResource;
use App\Http\Resources\CowResourceSimple;
use App\Models\Cow;
use App\Models\Vaccine;
use App\Traits\Search;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        ->when($data->vaccine_id, function($query) use($data){
            $query->whereHas('vaccines', function($query) use($data) {
                $query->where('id', $data->vaccine_id);
            });
        })

        ->when($data->gender, function($query) use($data){
            $query->where('gender', '=', $data->gender);
        })
        ->when($data->status, function($query) use($data){
            $query->where('status', '=', $data->status);
        })

        ->paginate();

        // $today = Carbon::now();
        // $tomorrow = $today->addDays(1);
        // $tomorrow = $tomorrow->format('Y-m-d');
        // $cows = Cow::whereHas('vaccines', function($query) use($tomorrow) {
        //     $query->where('vaccine_type', 'anthrax')
        //     ->where('next_vaccination_date', $tomorrow);
        // })->get();


        return CowResource::collection($cows);
    }

    /**
     * Store a new cow
    **/
    public function store($data)
    {
        $data['ear_tag_no'] = preg_replace('/\s+/', '-', $data['ear_tag_no']);
        return Cow::create($data);
    }


    public function update($data, $cow)
    {
        if(isset($data['ear_tag_no'])){
            $data['ear_tag_no'] = preg_replace('/\s+/', '-', $data['ear_tag_no']);
        }
        $cow->update($data);
        $cow->save();
    }
}
