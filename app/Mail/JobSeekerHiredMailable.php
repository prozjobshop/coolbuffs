<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobSeekerHiredMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $company)
    {
        $this->user = $user;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
                        
        return $this->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->to($this->user->email, $this->user->name)
                        ->subject("Congratulations " . $this->user->name . '" you have been hired by "' . $this->company->name)
                        ->view('emails.job_seeker_hired_message')
                        ->with(
                                [
                                    'job_title' => "TITLE",
                                    'company_name' => $this->company->name,
                                    'user_name' => $this->user->name,
                                    'company_link' => route('company.detail', $this->company->slug),
                                ]
        );
    }
}
