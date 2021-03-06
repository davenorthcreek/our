<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Respondent;

class NewRespondentGiven extends Notification
{
    use Queueable;

    private $respondent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Respondent $respondent)
    {
        $this->respondent = $respondent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->respondent->name. ' has responded. Their ISP is '.$this->respondent->isp)
                    ->action('View Response:', url('/response/'.$this->respondent->id))
                    ->line('Their satisfaction? '.$this->respondent->satisfaction);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
