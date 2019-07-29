<?php

namespace App\Controller;

use App\Entity\Despacho;
use App\Form\DespachoType;
use App\Repository\DespachoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/despacho")
 */
class DespachoController extends AbstractController
{
    /**
     * @Route("/", name="despacho_index", methods={"GET"})
     */
    public function index(DespachoRepository $despachoRepository): Response
    {
        return $this->render('despacho/index.html.twig', [
            'despachos' => $despachoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="despacho_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($despacho);
            $entityManager->flush();

            return $this->redirectToRoute('despacho_index');
        }

        return $this->render('despacho/new.html.twig', [
            'despacho' => $despacho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="despacho_show", methods={"GET"})
     */
    public function show(Despacho $despacho): Response
    {
        return $this->render('despacho/show.html.twig', [
            'despacho' => $despacho,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="despacho_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Despacho $despacho): Response
    {
        $form = $this->createForm(DespachoType::class, $despacho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('despacho_index');
        }

        return $this->render('despacho/edit.html.twig', [
            'despacho' => $despacho,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="despacho_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Despacho $despacho): Response
    {
        if ($this->isCsrfTokenValid('delete'.$despacho->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($despacho);
            $entityManager->flush();
        }

        return $this->redirectToRoute('despacho_index');
    }
}
