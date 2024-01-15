<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

// ToyChest Example: Laravel goes from the NewsletterController, checks the ApiClient and then the Configuration for the __construct for newsletter and finds nothing so it does it as new (Newsletter(new ApiClient));

// ToyChest Example: When adding another variable such as $foo Laravel doesn't know what to do with that.

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {
        //
    }
    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    // protected function client()
    // {
    //     // $mailchimp = new ApiClient();

    //     // // return $mailchimp->lists->addListMember('e078756d7c', [
    //     // //     'email_address'=> $email,
    //     // //     'status' => 'subscribed'
    //     // // ]);

    //     // return $mailchimp->setConfig([
    //     //     'apiKey' => config('services.mailchimp.key'),
    //     //     'server' => 'us12'
    //     // ]);

    //     // This is an inline of the above
    //     // return (new ApiClient())->setConfig([
    //     //     'apiKey' => config('services.mailchimp.key'),
    //     //     'server' => 'us12'
    //     // ]);
    //     return $this->client->setConfig([
    //         'apiKey' => config('services.mailchimp.key'),
    //         'server' => 'us12'
    //     ]);
    // }
}
