<?php

namespace App\Notifications;

use Tenancy\Facades\Tenancy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword as Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = config('app.url');

        if ($tenant = Tenancy::getTenant()) {
            $url = str_replace(config('app.domain'), '', $url) . $tenant->fqdn;
        }

        $url = url($url.'/password/reset/'.$this->token).'?email='.urlencode($notifiable->getEmailForPasswordReset());

        return $this->buildMailMessage($url);
    }
}
