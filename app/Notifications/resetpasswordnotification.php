<?php

namespace App\Notifications;

use Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\resetpasswordnotification;
use Illuminate\Notifications\Messages\MailMessage;

class resetpasswordnotification extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromemail;
    public $mailer;
    public $otp;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
          //
          $this->message='utiiser pour le process de reset pssword';
          $this->subject='verification necessaire ';
          $this->fromemail='test@dali.com';
          $this->mailer='smtp';
          $this->otp=new Otp;
      
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
    public function toMail(object $notifiable): MailMessage
    {
        $otp = $this->otp->generate($notifiable->email, 6, 60 ); 

        return (new MailMessage)
        ->mailer('smtp')
        ->subject($this->subject)
        ->line($this->message)
        ->line('code : '.$otp->token);    }

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
