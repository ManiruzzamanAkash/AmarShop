<?php

namespace App\Notifications;

use App\User;
use App\Productrequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendProductRequest extends Notification
{
    use Queueable;
    public $user;
    public $product_request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Productrequest $product_request)
    {
        $this->user = $user;
        $this->product_request = $product_request;
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
                    ->line('Here is a request for product you can sell yours')
                    ->line($this->product_request->title)
                    ->action('View Product', route('product.request_products.show', $this->product_request->slug))
                    ->line($this->product_request->price. 'Taka')
                    ->line('You can sell your product...');

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
