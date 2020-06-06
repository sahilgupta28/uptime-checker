<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($weekly_report)
    {
        $this->weekly_report = $weekly_report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $week = date('d-m-Y', strtotime('monday this week')) . ' - ' .
        date('d-m-Y', strtotime('sunday this week'));
        return $this->from(env('SEND_EMAIL_FROM'))
                ->subject(__('Weekly Report ') . $week)
                ->view('emails.weekly-report')
                ->with([
                    'weekly_report' => $this->weekly_report
                ]);
    }
}
