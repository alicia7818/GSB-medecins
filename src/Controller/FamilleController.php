<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Form\FamilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille")
 */
class FamilleController extends AbstractController
{
    /**
     * @Route("/", name="famille_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $familles = $entityManager
            ->getRepository(Famille::class)
            ->findAll();

        return $this->render('famille/index.html.twig', [
            'familles' => $familles,
        ]);
    }

    /**
     * @Route("/new", name="famille_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('famille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille/new.html.twig', [
            'famille' => $famille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="famille_show", methods={"GET"})
     */
    public function show(Famille $famille): Response
    {
        return $this->render('famille/show.html.twig', [
            'famille' => $famille,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="famille_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Famille $famille, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('famille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('famille/edit.html.twig', [
            'famille' => $famille,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="famille_delete", methods={"POST"})
     */
    public function delete(Request $request, Famille $famille, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$famille->getId(), $request->request->get('_token'))) {
            $entityManager->remove($famille);
            $entityManager->flush();
        }

        return $this->redirectToRoute('famille_index', [], Response::HTTP_SEE_OTHER);
    }
}
