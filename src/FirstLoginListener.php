<?php

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FirstLoginListener implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin',
        ];
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        // Vérifier si c'est la première connexion du salarié
        if ($user->isFirstLogin()) {
            $email = (new Email())
                ->from('noreply@votredomaine.com')
                ->to($user->getEmail())
                ->subject('Changement de mot de passe')
                ->html($this->renderView('/templates/emails/first_login_password.html.twig'));

            $this->mailer->send($email);

            // Marquer la première connexion comme traitée
            $user->setFirstLogin(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
    }
}
