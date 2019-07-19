<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Entity\Theater;
use App\Form\ContactType;
use App\Service\EmailService;
use App\Service\MapadoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, \Swift_Mailer $mailer, EmailService $emailService)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $emailService->mailContactForm(
                $contactFormData['Votre_Email'],
                $contactFormData['Votre_Message'],
                $contactFormData['Votre_Nom']
            );

            $this->addFlash('success', 'Votre message a bien été envoyé');
            dump($contactFormData);
            return $this->redirectToRoute('home');
        }


        return $this->render('index.html.twig', [
            'email_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/infos/{id}", name="theater_show_visitors", methods={"GET"})
     * @param Theater $theater
     * @return Response
     */
    public function showVisitors(Theater $theater, Spectacle $spectacle): Response
    {
        return $this->render('theater/showVisitors.twig', [
            'theater' => $theater,
            'spectacle' => $spectacle]);
    }
}
