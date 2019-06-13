<?php

namespace App\Controller;

use App\Entity\Theater;
use App\Form\TheaterType;
use App\Repository\TheaterRepository;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/theater")
 * @isGranted("ROLE_THEATER")
 */
class TheaterController extends AbstractController
{
    /**
     * @Route("/", name="theater_index", methods={"GET"})
     * @isGranted("ROLE_ADMIN")
     * @param TheaterRepository $theaterRepository
     * @return Response
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
     * @param Request $request
     * @return Response
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
     * @param Theater $theater
     * @return Response
     */
    public function show(Theater $theater): Response
    {
        return $this->render('theater/show.html.twig', [
            'theater' => $theater,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="theater_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Theater $theater
     * @return Response
     * @throws GuzzleException
     */
    public function edit(Request $request, Theater $theater): Response
    {
        $form = $this->createForm(TheaterType::class, $theater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $street = $theater->getAddress1();
            $zipCode = $theater->getZipCode();
            $city = $theater->getCity();

            $address = $street . " " . $zipCode . " " . $city;

            $client = new Client([
                    'base_uri' => 'https://nominatim.openstreetmap.org/',
                ]);

            $response = $client->request('GET', 'search.php?q='
                 . urlencode($address)
                 . '&format=json');
            $body = $response->getBody();
            $obj = json_decode($body->getContents(), true);
            $latitude = $obj[0]['lat'];
            $longitude = $obj[0]['lon'];
            $theater->setLongitude($longitude)
                    ->setLat($latitude);
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
     * @param Request $request
     * @param Theater $theater
     * @return Response
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
