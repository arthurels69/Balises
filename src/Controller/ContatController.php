<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContatController extends AbstractController
{
    /**
     * @Route("/contact", name="contat")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('You Got Mail from Symfony 4!'))

                ->setFrom($contactFormData['Votre_Email'])
                ->setTo('mariner.connor@gmail.com')
                ->setBody(
                    $contactFormData['Votre_Message'],

                    'text/plain'
                )
            ;

            $mailer->send($message);

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('home');
        }

        return $this->render('contat/index.html.twig', [
            'email_form' => $form->createView(),
        ]);
    }
}
