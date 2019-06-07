<?php

namespace App\Controller;

use App\Entity\Theater;
use App\Form\TheaterType;
use App\Repository\TheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/theater")
 */
class TheaterController extends AbstractController
{
    /**
     * @Route("/", name="theater_index", methods={"GET"})
     */
    public function index(TheaterRepository $theaterRepository): Response
    {
        return $this->render('theater/index.html.twig', [
            'theaters' => $theaterRepository->findAll(),
        ]);
    }


    //* @IsGranted("ROLE_ADMIN")
    /**

     * @Route("/new", name="theater_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $theater = new Theater();
        $form = $this->createForm(TheaterType::class, $theater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user =  $this->getUser();
            $theater->setuser($user);
            $entityManager->persist($theater);
            $entityManager->flush();

            return $this->redirectToRoute('theater_index');
        }

        return $this->render('theater/new.html.twig', [
            'theater' => $theater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="theater_show", methods={"GET"})
     */
    public function show(Theater $theater): Response
    {
        return $this->render('theater/show.html.twig', [
            'theater' => $theater,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="theater_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Theater $theater): Response
    {
        $form = $this->createForm(TheaterType::class, $theater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('theater_index', [
                'id' => $theater->getId(),
            ]);
        }

        return $this->render('theater/edit.html.twig', [
            'theater' => $theater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="theater_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Theater $theater): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theater->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($theater);
            $entityManager->flush();
        }

        return $this->redirectToRoute('theater_index');
    }
}
