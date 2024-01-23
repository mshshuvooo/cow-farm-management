<?php

namespace App\Console\Commands;

use App\Http\Resources\CowResource;
use App\Models\Cow;
use App\Models\User;
use App\Notifications\VaccineNotofication;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class FmdVaccineNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine-notification:fmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification for FMD vaccine';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $tomorrow = $today->addDays(1);
        $next_vaccination_date = $tomorrow->format('Y-m-d');
        $vaccine_type = 'fmd';
        $cows = Cow::whereHas('vaccines',
        function($query) use($next_vaccination_date) {
            $query->where('next_vaccination_date', $next_vaccination_date);
        })->get();
        $user = User::find(1);

        if(count($cows) > 0){
            Notification::send($user, new VaccineNotofication(
                CowResource::collection($cows),
                $vaccine_type,
                $next_vaccination_date
            ));
        }

    }
}
