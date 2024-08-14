<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategoryNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Category Notification')
            ->line('Category ' . $this->category . ' has been created or deleted.')
            ->action('View Category', url('/categories/' . $this->category))
            ->line('Thank you for using our application!');
        // ->subject('Category Notification')
        // ->line('Category ' . $this->category->name . ' has been created or deleted.')
        // ->action('View Category', url('/categories/' . $this->category->id))
        // ->line('Thank you for using our application!');
    }
    // public function toArray($notifiable)
    // {
    //     return [
    //         'category' => $this->category
    //     ];
    // }
}
