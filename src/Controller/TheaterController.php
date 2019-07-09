<?php

namespace App\Controller;

use App\Entity\Theater;
use App\Form\TheaterType;
use App\Repository\TheaterRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use App\Service\TheaterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use GuzzleHttp\Client;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

//    /**
//     * @Route("/new", name="theater_new", methods={"GET","POST"})
//     * @param Request $request
//     * @return Response
//     */
//    public function new(Request $request): Response
//    {
//
//        $theater = new Theater();
//        $form = $this->createForm(TheaterType::class, $theater);
//        $form->handleRequest($request);
//
//
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $user =  $this->getUser();
//            $theater->setuser($user);
//            $entityManager->persist($theater);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('theater_index');
//        }
//
//        return $this->render('theater/new.html.twig', [
//            'theater' => $theater,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="theater_show", methods={"GET"})
     * @param Theater $theater
     * @return Response
     */
    public function show(Theater $theater): Response
    {
        $user =  $this->getUser();
        $userEmail = $user->getEmail();
        $email = $theater->getEmail();

        if ($email != $userEmail) {
            throw $this->createAccessDeniedException("Accès refusé ! Vous n'êtes pas le théâtre logué !!");
        }
        return $this->render('theater/show.html.twig', [
            'theater' => $theater,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="theater_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ObjectManager $manager
     * @param Theater $theater
     * @param TheaterService $theaterService
     * @param UserPasswordEncoderInterface $encoder
     * @param FileUploader $fileUploader
     * @return Response
     * @throws Exception
     */
    public function edit(
        Request $request,
        ObjectManager $manager,
        Theater $theater,
        TheaterService $theaterService,
        UserPasswordEncoderInterface $encoder,
        FileUploader $fileUploader
    ): Response {

        $form = $this->createForm(TheaterType::class, $theater);
        $form->handleRequest($request);
        $user =  $this->getUser();

        $request->request->get('newPassword');
        $newPassword = $request->request->get('newPassword');
        $request->request->get('confirmPassword');
        $confirmPassword = $request->request->get('confirmPassword');


        if ($form->isSubmitted() && $form->isValid()) {
            if ($newPassword == $confirmPassword) {
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($hash);

                $manager->persist($user);
            } else {
                $this->addFlash('danger', 'Les mot de passe ne correspondent pas');
                return $this->redirectToRoute('theater_edit', [
                    'id' => $theater->getId()
                ]);
            }
            $theaterService->geocode($theater);

            /** @var UploadedFile $file */
//            $fileLogo = $request->files->get('theater')['logo'];
            $fileLogo = $form['logo']->getData();
            if ($fileLogo) {
                $fileLogoName = $fileUploader->upload($fileLogo);
                $theater->setLogo($fileLogoName);
            }

            /** @var UploadedFile $file */
            $filePicture = $request->files->get('theater')['picture'];
            if ($filePicture) {
                $filePictureName = $fileUploader->upload($filePicture);
                $theater->setPicture($filePictureName);
            }

            $this->getDoctrine()->getManager()->flush();

            // Once the form is submitted, valid and the data inserted in database, you can define
            // the success flash message
            $this->addFlash(
                'success',
                'Vos changements ont bien été enregistrés !'
            );

            return $this->redirectToRoute('theater_show', [
                'id' => $theater->getId(),
            ]);
        }

        return $this->render('theater/edit.html.twig', [
            'theater' => $theater,
            'form' => $form->createView(),
            'user' => $user,
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
