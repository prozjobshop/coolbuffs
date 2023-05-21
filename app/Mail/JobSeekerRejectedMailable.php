<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobSeekerRejectedMailable extends Mailable
{

    use SerializesModels;

    public $job;
    public $jobApplyRejected;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job, $jobApplyRejected)
    {
        $this->job = $job;
        $this->jobApplyRejected = $jobApplyRejected;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = $this->job->getCompany();
        $user = $this->jobApplyRejected->getUser();

        return $this->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->to($user->email, $user->name)
                        ->subject($user->name . '" you have rejected for this job "' . $this->job->title)
                        ->view('emails.job_seeker_rejected_message')
                        ->with(
                                [
                                    'job_title' => $this->job->title,
                                    'company_name' => $company->name,
                                    'user_name' => $user->name,
                                    'company_link' => route('company.detail', $company->slug),
                                    'job_link' => route('job.detail', [$this->job->slug])
                                ]
        );
    }

}
