<?php

namespace App\Service;

use Mailjet\Client;
use Mailjet\Resources;
use Twig\Environment;

class MailJetService
{
    private $mj;
    private $twig;

    public function __construct(string $mailjetApiKey, string $mailjetApiSecret, Environment $twig)
    {
        $this->mj = new Client($mailjetApiKey, $mailjetApiSecret, true, ['version' => 'v3.1']);
        $this->twig = $twig;
    }

    public function sendEmail($toEmail, $toName, $subject, $template, $context = [])
    {
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "votre-email@example.com",
                        'Name' => "Votre Nom"
                    ],
                    'To' => [
                        [
                            'Email' => $toEmail,
                            'Name' => $toName
                        ]
                    ],
                    'Subject' => $subject,
                    'HTMLPart' => $this->twig->render($template, $context)
                ]
            ]
        ];

        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success() && $response->getData();
    }
}
