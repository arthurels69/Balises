<?php


namespace App\Service;

use Twig\Environment;

class EmailService
{

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function mailContactForm($from, $message, $name)
    {
        $email = new \Swift_Message('Nouveau Mail Contact de '. $from);

        $email->setFrom('balises@caramail.fr')
            ->setTo('balises@caramail.fr')
            ->setBody($this->twig->render('Email/newMessage.html.twig', [
                'message' => $message,
                'from' => $from,
                'name' => $name
            ]), 'text/html');

        $this->mailer->send($email);
    }
}
