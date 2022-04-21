<?php

namespace App\Controller;

use App\Entity\Offrir;
use App\Form\OffrirType;
use App\Repository\OffrirRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offrir")
 */
class OffrirController extends AbstractController
{
    /**
     * @Route("/", name="offrir_index", methods={"GET"})
     */
    public function index(OffrirRepository $offrirRepository): Response
    {
        return $this->render('offrir/index.html.twig', [
            'offrirs' => $offrirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="offrir_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offrir = new Offrir();
        $form = $this->createForm(OffrirType::class, $offrir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offrir);
            $entityManager->flush();

            return $this->redirectToRoute('offrir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offrir/new.html.twig', [
            'offrir' => $offrir,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="offrir_show", methods={"GET"})
     */
    public function show(Offrir $offrir): Response
    {
        return $this->render('offrir/show.html.twig', [
            'offrir' => $offrir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offrir_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offrir $offrir, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffrirType::class, $offrir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('offrir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offrir/edit.html.twig', [
            'offrir' => $offrir,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="offrir_delete", methods={"POST"})
     */
    public function delete(Request $request, Offrir $offrir, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offrir->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offrir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offrir_index', [], Response::HTTP_SEE_OTHER);
    }
}
