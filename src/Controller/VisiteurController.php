<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\VisiteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visiteur")
 */
class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="visiteur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $visiteurs = $entityManager
            ->getRepository(Visiteur::class)
            ->findAll();

        return $this->render('visiteur/index.html.twig', [
            'visiteurs' => $visiteurs,
        ]);
    }

        /**
     * @Route("/", name="visiteur_suivi", methods={"GET"})
     */
    public function suivi(EntityManagerInterface $entityManager): Response
    {
        $visiteurs = $entityManager
            ->getRepository(Visiteur::class)
            ->findBy(array ('nom' => 'desc'));


        return $this->render('visiteur/suivi.html.twig', [
            'visiteurs' => $visiteurs
        ]);
    }

    /**
     * @Route("/new", name="visiteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($visiteur);
            $entityManager->flush();

            return $this->redirectToRoute('visiteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiteur/new.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiteur_show", methods={"GET"})
     */
    public function show(Visiteur $visiteur): Response
    {
        return $this->render('visiteur/show.html.twig', [
            'visiteur' => $visiteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visiteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Visiteur $visiteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('visiteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiteur/edit.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Visiteur $visiteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visiteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($visiteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visiteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
