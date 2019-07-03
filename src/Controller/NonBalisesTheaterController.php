<?php

namespace App\Controller;

use App\Entity\NonBalisesTheater;
use App\Form\NonBalisesTheaterType;
use App\Repository\NonBalisesTheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/non/balises/theater")
 */
class NonBalisesTheaterController extends AbstractController
{
    /**
     * @Route("/", name="non_balises_theater_index", methods={"GET"})
     */
    public function index(NonBalisesTheaterRepository $nonBalisesTheaterRepository): Response
    {
        return $this->render('non_balises_theater/index.html.twig', [
            'non_balises_theaters' => $nonBalisesTheaterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="non_balises_theater_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nonBalisesTheater = new NonBalisesTheater();
        $form = $this->createForm(NonBalisesTheaterType::class, $nonBalisesTheater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nonBalisesTheater);
            $entityManager->flush();

            return $this->redirectToRoute('non_balises_theater_index');
        }

        return $this->render('non_balises_theater/new.html.twig', [
            'non_balises_theater' => $nonBalisesTheater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="non_balises_theater_show", methods={"GET"})
     */
    public function show(NonBalisesTheater $nonBalisesTheater): Response
    {
        return $this->render('non_balises_theater/show.html.twig', [
            'non_balises_theater' => $nonBalisesTheater,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="non_balises_theater_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NonBalisesTheater $nonBalisesTheater): Response
    {
        $form = $this->createForm(NonBalisesTheaterType::class, $nonBalisesTheater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('non_balises_theater_index', [
                'id' => $nonBalisesTheater->getId(),
            ]);
        }

        return $this->render('non_balises_theater/edit.html.twig', [
            'non_balises_theater' => $nonBalisesTheater,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="non_balises_theater_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NonBalisesTheater $nonBalisesTheater): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nonBalisesTheater->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nonBalisesTheater);
            $entityManager->flush();
        }

        return $this->redirectToRoute('non_balises_theater_index');
    }
}
