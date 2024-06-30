<?php

// src/Controller/EmailController.php

namespace App\Controller;

use App\Entity\User;
use App\Service\MailJetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    private $mailJetService;

    public function __construct(MailJetService $mailJetService)
    {
        $this->mailJetService = $mailJetService;
    }

    /**
     * @Route("/send-email/{user_id}", name="send_email", methods={"GET"})
     */
    public function sendEmail(int $user_id): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $toEmail = $user->getEmail();
        $toName = $user->getFirstname() . ' ' . $user->getLastname();
        $subject = "Bienvenue sur notre site";
        $template = 'emails/email_template.html.twig';
        $context = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
        ];

        // Envoyer l'email via le service MailJet
        $this->mailJetService->sendEmail($toEmail, $toName, $subject, $template, $context);

        return new Response('Email envoyé avec succès');
    }
}
