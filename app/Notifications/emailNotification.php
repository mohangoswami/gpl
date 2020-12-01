<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class emailNotification extends Notification
{
    use Queueable;

    protected $class,$subject,$title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($workType,$classworkId,$class,$subject,$title,$type)
    {
        $this->workType = $workType;
        $this->classworkId = $classworkId;
        $this->class = $class;
        $this->subject = $subject;
        $this->title = $title;
        $this->type = $type;
       
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'workType' =>$this->workType,
            'classworkId' => $this->classworkId,
            'class' => $this->class,
            'subject' => $this->subject,
            'title' => $this->title,
            'type' => $this->type,
            
        ];
    }
}
