<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Repositories\Website\WebsiteRepository;
use App\Models\Website;
use App\Helpers\Helper;

class TestSuccessNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        if (!$notifiable->slack_hook) {
            return false;
        }
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $title = "Your website $notifiable->title ($notifiable->domain) is back.";
        return (new SlackMessage)
                        ->success()
                        ->from('Uptime Checker')
                        ->attachment(function ($attachment) use ($notifiable, $title) {
                            $attachment->title(
                                $title,
                                route('home')
                            )
                            ->fields([
                                'Title' => $notifiable->title,
                                'Domain' => $notifiable->domain,
                                'Status' => 'UP',
                                'Tested At' => $notifiable->test_at->format('M d, Y H:i')
                            ]);
                        });
    }
}
