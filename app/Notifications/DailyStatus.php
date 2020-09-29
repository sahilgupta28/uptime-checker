<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Helpers\Helper;

class DailyStatus extends Notification
{
    use Queueable;

    public function __construct($website)
    {
        $this->website = $website;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                        ->from('Uptime Checker')
                         ->attachment(function ($attachment) use ($notifiable) {
                             $attachment->title(
                                 'Daily Status | ' . env('APP_ENV') . ' | ' . date('d-m-Y')
                             )->fields([
                                 'Title' => $this->website->title,
                                 'Domain' => $this->website->domain,
                                 'Down Time' => $this->website->website_downtime,
                                 'Uptime' => config('constants.DAY_MINUTES') - $this->website->website_downtime,
                                 'Down Time %' => Helper::calculatePercentage(config('constants.DAY_MINUTES'), $this->website->website_downtime),
                                 'Uptime %' => Helper::calculatePercentage(config('constants.DAY_MINUTES'), (config('constants.DAY_MINUTES') - $this->website->website_downtime))
                             ]);
                         });
    }
}
