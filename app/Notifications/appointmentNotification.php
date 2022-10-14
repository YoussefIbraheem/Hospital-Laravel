<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class appointmentNotification extends Notification
{
    use Queueable;
    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
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
                    ->greeting("Dear ".$this->details['name'])
                    ->line("Thank You for submitting your request for a visit to doctor ".$this->details->doctor->name." in date ".$this->details['date']." on ".$this->details['appointment'])
                    ->line("We would like to inform you that your request has been")
                    ->line( ucfirst($this->details['status']) )
                    ->lineIf($this->details['status'] == 'rejected' , 'Please visit our website if you would like to submit a different appointment or call us on the number provided on the web app !')
                    ->lineIf($this->details['status'] == 'approved' ,'Please be at the Hospital premise before the appointment by 15 minutes to complete the registration process, you`ll find the doctor in room '.$this->details->doctor->room_no.'!')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our One-Hospital application!');
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
