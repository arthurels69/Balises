<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Entity\Theater;
use App\Form\SpectacleType;
use App\Repository\SpectacleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @Route("/spectacle")
 */
class SpectacleController extends AbstractController
{
    /**
     * @Route("/", name="spectacle_index", methods={"GET"})
     * @param SpectacleRepository $spectacleRepository
     * @return Response
     */
    public function index(SpectacleRepository $spectacleRepository): Response
    {
        return $this->render('spectacle/index.html.twig', [
            'spectacles' => $spectacleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="spectacle_new", methods={"GET","POST"})
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function new(Request $request, ObjectManager $manager): Response
    {
        $spectacle = new Spectacle();
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($spectacle);
            $manager->flush();

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render('spectacle/new.html.twig', [
            'spectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectacle_show", methods={"GET"})
     * @param Spectacle $spectacle
     * @return Response
     */
    public function show(Spectacle $spectacle): Response
    {
        return $this->render('spectacle/show.html.twig', [
            'spectacle' => $spectacle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spectacle_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Spectacle $spectacle
     * @return Response
     */
    public function edit(Request $request, Spectacle $spectacle): Response
    {
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spectacle_index', [
                'id' => $spectacle->getId(),
            ]);
        }

        return $this->render('spectacle/edit.html.twig', [
            'spectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectacle_delete", methods={"DELETE"})
     * @param Request $request
     * @param Spectacle $spectacle
     * @return Response
     */
    public function delete(Request $request, Spectacle $spectacle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spectacle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spectacle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spectacle_index');
    }
}
