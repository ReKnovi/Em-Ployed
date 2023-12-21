<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $previousStatus;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application, $previousStatus, $content)
    {
        $this->application = $application;
        $this->previousStatus = $previousStatus;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Application Status Updated';

        switch ($this->application->status) {
            case 'first_interview':
                $content = 'You have been invited for an interview.';
                break;
            case 'hired':
                $content = 'Congratulations! You have been hired.';
                break;
            case 'rejected':
                $content = 'We regret to inform you that your application has been rejected.';
                break;
            default:
                $content = 'Your application status has been updated.';
        }
    
        return $this->markdown('emails.application-status-updated')
            ->with([
                'application' => $this->application,
                'previousStatus' => $this->previousStatus,
                'content' => $content,
            ])
            ->subject($subject);
    }
}
