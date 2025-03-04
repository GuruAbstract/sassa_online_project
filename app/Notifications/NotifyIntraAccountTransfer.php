<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Account;
class NotifyIntraAccountTransfer extends Notification
{
    use Queueable;

    private $accountfrom;
    private $accountto;
    private $amounttransfered;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Account $accountfrom,Account $accountto,$amount)
    {
        $this->accountfrom=$accountfrom;
        $this->accountto=$accountto;
        $this->amounttransfered=$amount;


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
                    ->subject('Intra Account Transfer. for an Amount of '.$this->amounttransfered)
                    ->greeting('Dear Customer')
                    ->line('New balance of the account '.$this->accountto->accountno. ' is '.$this->accountto->balance)
                    ->line('New balance of the account '.$this->accountfrom->accountno. ' is '.$this->accountfrom->balance)
                    ->line('Thank you for using our application!');



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
