<?php

namespace App\Controller;

use App\Entity\ShowDate;
use App\Entity\Spectacle;
use App\Entity\ShowRate;
use App\Form\ShowDateType;
use App\Repository\ShowDateRepository;
use App\Repository\SpectacleRepository;
use App\Repository\TheaterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/show/date")
 */
class ShowDateController extends AbstractController
{
    /**
     * @Route("/", name="show_date_index", methods={"GET"})
     * @param ShowDateRepository $showDateRepository
     * @return Response
     */
    public function index(ShowDateRepository $showDateRepository) : Response
    {

        return $this->render('show_date/index.html.twig', [
            'show_dates' => $showDateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new2", name="show_date_new", methods={"GET","POST"})
     */
    public function new2(Request $request, Spectacle $Spectacle, ShowDateRepository $showDateRepository): Response
    {
        $showDate = new ShowDate();
        $form = $this->createForm(ShowDateType::class, $showDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($showDate);
            $entityManager->flush();

            return $this->redirectToRoute('show_date_index');
        }

        return $this->render('show_date/new.html.twig', [
            'show_date' => $showDate,
            'showDates' => $showDateRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/new", name="showDate_by_Spectacle", methods={"GET","POST"})
     */
    public function indexBySpectacle(
        SpectacleRepository $spectacleRepository,
        ShowDateRepository $showDateRepository,
        Request $request,
        $id
    ): Response {

        $showDate = new ShowDate();

        $form = $this->createForm(ShowDateType::class, $showDate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $showDate->setShowId($spectacleRepository->findOneBy(['id'=>$id]));
            $entityManager->persist($showDate);
            $entityManager->flush();

            return $this->redirectToRoute('showDate_by_Spectacle', [
                'id' => $id
            ]);
        }


        return $this->render('show_date/new.html.twig', [
            'showDates' => $showDateRepository->findby(['showId' => $id]),
            'spectacle' => $spectacleRepository->findOneBy(['id'=>$id]),
            'show_date' => $showDate,
            'form' => $form->createView()

        ]);
    }



    /**
     * @Route("/{id}", name="show_date_show", methods={"GET"})
     */
    public function show(ShowDate $showDate): Response
    {
        return $this->render('show_date/show.html.twig', [
            'show_date' => $showDate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="show_date_edit", methods={"GET","POST"})
     */
    public function edit(
        ShowDateRepository $showDateRepository,
        Request $request,
        ShowDate $showDate
    ): Response {
        $form = $this->createForm(ShowDateType::class, $showDate);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('showDate_by_Spectacle', [
                'id' => $showDate->getId(),
            ]);
        }

        return $this->render('show_date/edit.html.twig', [
            'showDates' => $showDateRepository->findAll(),
            'show_date' => $showDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show_date_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ShowDate $showDate): Response
    {

        $spectacle = $showDate->getShowId();
        if ($this->isCsrfTokenValid('delete'.$showDate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($showDate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('showDate_by_Spectacle', ['id'=>$spectacle]);
    }
}
