<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// 
class ClientTicket extends Notification implements ShouldQueue
{
    use Queueable;
    public $ticket_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket_data)
    {
        $this->ticket_data = $ticket_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('New Ticket')
                    ->greeting('Hello '. $this->ticket_data->user_from_ticket->name. ',')
                    ->line('Your new created ticket id is '. $this->ticket_data->id)
                    ->action('View Your Ticket', url(route('client.ticketcreate.index')))
                    ->line('Thank you!');
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
            'ticket_id' => $this->ticket_data->id
        ];
    }
}
