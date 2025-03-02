<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use RapidCMS\Core\Mail\DynamicMail;
use RapidCMS\Core\Mail\DynamicMailQueued;
use RapidCMS\Core\Models\MailTemplate;

trait HasMailable
{
    protected mixed $cc = null;

    protected mixed $bcc = null;

    public function mail(MailTemplate|string|int $template, array $replaceable): static
    {
        $mailTemplate = new MailTemplate;
        if (is_int($template)) {
            $mailTemplate = MailTemplate::where('id', $template)->first();
        } elseif (is_string($template)) {
            $mailTemplate = MailTemplate::where('code', $template)->first();
        } elseif (gettype($template) == MailTemplate::class) {
            $mailTemplate = $template;
        }
        $mailBody = $mailTemplate->content;
        $mailSubject = $mailTemplate->subject;

        // Replace User Defined Variables
        foreach (array_keys($replaceable) as $key) {
            $mailBody = str_replace($key, $replaceable[$key], $mailBody);
            $mailSubject = str_replace($key, $replaceable[$key], $mailSubject);
        }

        // / Replace default variables
        $mailBody = replaceDefaultVariables($mailBody);
        $mailSubject = replaceDefaultVariables($mailSubject);

        // Send the mail to provided user
        // With provided mail template
        $mail = Mail::to($this->email);
        if ($this->cc) {
            $mail->cc($this->cc);
        }
        if ($this->bcc) {
            $mail->bcc($this->bcc);
        }

        if ((int) getSetting('mail_queue_enabled')) {
            $mail->send(new DynamicMailQueued($mailSubject, $mailBody));
        } else {
            $mail->send(new DynamicMail($mailSubject, $mailBody));
        }

        return $this;
    }

    public function cc(mixed $users): static
    {
        $this->cc = $users;

        return $this;
    }

    public function bcc(mixed $users): static
    {
        $this->bcc = $users;

        return $this;
    }
}
