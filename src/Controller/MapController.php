<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Form\ContactType;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
use App\Repository\ShowDateRepository;
use App\Service\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends AbstractController
{

    /**
     * @Route("/map", name="map2")
     */
    public function map2(
        TheaterRepository $theaterRepository,
        SpectacleRepository $spectacleRepository,
        ShowDateRepository $dateRepository,
        ShowDateRepository $showDateRepository,
        EmailService $emailService,
        Request $request
    ) {

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
            return $this->redirectToRoute('map2');
        }


        return $this->render('home/map2.html.twig', [
            'theaters' => $theaterRepository->findAll(),
            'spectacles' => $spectacleRepository->findAll(),
            'showdates' =>$dateRepository->findAll(),
            'email_form' => $form->createView(),

        ]);
    }
}
