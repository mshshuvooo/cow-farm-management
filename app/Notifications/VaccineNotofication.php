<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccineNotofication extends Notification
{
    use Queueable;
    public $cows;
    public $vaccine_type;
    public $next_vaccination_date;

    /**
     * Create a new notification instance.
     */
    public function __construct($cows,  $vaccine_type, $next_vaccination_date)
    {
        $this->cows = $cows;
        $this->vaccine_type = $vaccine_type;
        $this->next_vaccination_date = $next_vaccination_date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        $cows = $this->cows;
        $vaccine_type = $this->vaccine_type;
        $next_vaccination_date = $this->next_vaccination_date;
        return (new MailMessage)->view('notification/vaccineNotification', compact('cows', 'vaccine_type', 'next_vaccination_date'));
        //dd($cows);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
