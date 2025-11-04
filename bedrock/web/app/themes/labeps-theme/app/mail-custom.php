<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Facades\Mail;
use WPCF7_Submission;

add_action('wpcf7_before_send_mail', function ($contact_form) {
    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $data = $submission->get_posted_data();

        $mail = $contact_form->prop('mail');

        $to = $mail['recipient'];
        $subject = $mail['subject'];
        $body = $mail['body'];
        $headers = $mail['additional_headers'];

        // Personnalisez le corps de l'email en utilisant les données soumises
        $body .= "\n\n";
        foreach ($data as $key => $value) {
            $body .= ucfirst($key) . ": " . $value . "\n";
        }

        Mail::raw($body, function ($message) use ($to, $subject, $headers) {
            $message->to($to)
                ->subject($subject)
                ->setHeaders($headers)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        // Prevent CF7 from sending its own email
        $contact_form->skip_mail = true;
    }
});
