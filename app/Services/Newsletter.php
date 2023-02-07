<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email)
    {
        $mailChimp = new ApiClient();

        $mailChimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us18'
        ]);

        return $mailChimp->lists->addListMember([
            "email" => $email,
            'status' => 'subscribed'

        ]);
    }

    public function unsubscribe()
    {
    }
}
