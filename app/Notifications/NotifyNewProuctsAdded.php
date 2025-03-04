<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Illuminate\Notifications\Messages\MailMessage;
use App\Product;
use Illuminate\Notifications\Messages\BroadcastMessage;
class NotifyNewProuctsAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $productid;
    private $amount;
    public function __construct($productid,$amount)
    {
       $this->productid=$productid;

        $this->amount=$amount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                     ->subject('New Product added')
                     ->greeting('Dear '. $notifiable->name.' '.$notifiable->surname)
                    ->line('New Products have been added to our system.')
                    ->action('Click here to view our products', url('http://localhost:8000/product/'.$this->productid))
                    ->line('Thank you for using our application!');



    }



    public function toBroadcast($notifiable)
    {

        $product=Product::find($this->productid);
     return (new BroadcastMessage(
                      [
                        'type'=>$product->producttype,
                        'productid' => $this->productid,
                        'productname'=>$product->productname,

                        'amount' => $this->amount,
                    ]))
         ->onConnection('sqs')
         ->onQueue('broadcasts');
    }






    public function toDatabase($notifiable)
    {
            $product=Product::find($this->productid);

        return [
            'type'=>$product->producttype,
            'productid' => $this->productid,
            'productname'=>$product->productname,

            'amount' => $this->amount,
        ];
    }


    public function toArray($notifiable)
    {
        $product=Product::find($this->productid);

        return [
            'type'=>$product->producttype,
            'productid' => $this->productid,
            'productname'=>$product->productname,

            'amount' => $this->amount,
        ];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

}
