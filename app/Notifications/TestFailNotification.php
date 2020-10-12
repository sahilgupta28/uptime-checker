<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Helpers\Helper;

class TestFailNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        if (!$notifiable->slack_hook) {
            return false;
        }
        if (!Helper::CheckNotificationStatus($notifiable->notification_key)) {
            return false;
        }
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                        ->from('Uptime Checker')
                         ->attachment(function ($attachment) use ($notifiable) {
                             $attachment->title(
                                 'Your website is down | ' . env('APP_ENV'),
                                 env('IMAGE_BASE_URL')
                             )
                                   ->fields([
                                       'Title' => $notifiable->title,
                                       'Domain' => $notifiable->domain,
                                       'Status' => 'FAIL',
                                       'Tested At' => $notifiable->test_at->format('M d, Y H:i')
                                   ]);
                         });
    }
}
