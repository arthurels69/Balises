<?php

namespace App\Controller;

use App\Entity\Param;
use App\Form\ParamType;
use App\Repository\ParamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/param")
 */
class ParamController extends AbstractController
{
    /**
     * @Route("/", name="param_index", methods={"GET"})
     */
    public function index(ParamRepository $paramRepository): Response
    {
        return $this->render('param/index.html.twig', [
            'params' => $paramRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="param_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $param = new Param();
        $form = $this->createForm(ParamType::class, $param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($param);
            $entityManager->flush();

            return $this->redirectToRoute('param_index');
        }

        return $this->render('param/new.html.twig', [
            'param' => $param,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="param_show", methods={"GET"})
     */
    public function show(Param $param): Response
    {
        return $this->render('param/show.html.twig', [
            'param' => $param,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="param_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Param $param): Response
    {
        $form = $this->createForm(ParamType::class, $param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param_index', [
                'id' => $param->getId(),
            ]);
        }

        return $this->render('param/edit.html.twig', [
            'param' => $param,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="param_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Param $param): Response
    {
        if ($this->isCsrfTokenValid('delete'.$param->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($param);
            $entityManager->flush();
        }

        return $this->redirectToRoute('param_index');
    }
}
