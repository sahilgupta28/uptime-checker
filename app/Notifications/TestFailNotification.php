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

class TestFailNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        if (!$notifiable->slack_hook) {
            return false;
        }
        if (!Helper::CheckNotificationStatus($notifiable->notification_key, $notifiable->notification_started_at)) {
            return false;
        }
        $website = new WebsiteRepository(new Website());
        $website->updateNotificationKey($notifiable->id, $notifiable->notification_key, $notifiable->notification_started_at);
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $title = "Your website $notifiable->title ($notifiable->domain) is down";
        if ($notifiable->notification_key >= 1) {
            $title .= ' since ' . date(
                config('constants.DATE_TIME_FORMAT_SLACK'),
                strtotime($notifiable->status_updated_at)
            ) . ' (' . $notifiable->status_updated_at->diffForHumans() . ')';
        }
        return (new SlackMessage)
                        ->error()
                        ->from('Uptime Checker')
                        ->attachment(function ($attachment) use ($notifiable, $title) {
                            $attachment->title(
                                $title,
                                route('home')
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
