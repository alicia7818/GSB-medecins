<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Form\RapportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rapport")
 */
class RapportController extends AbstractController
{
    /**
     * @Route("/", name="rapport_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rapports = $entityManager
            ->getRepository(Rapport::class)
            ->findAll();

        return $this->render('rapport/index.html.twig', [
            'rapports' => $rapports,
        ]);
    }

    /**
     * @Route("/new", name="rapport_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapport = new Rapport();
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rapport = $form->getData();
            //Enregistrer des médicaments dans la table offrir pour chaque médicament contenu dans le rapport
            foreach($rapport->getOffrirs() as $offrir){
                $entityManager->persist($offrir);
            }

            $entityManager->persist($rapport);
            $entityManager->flush();

            return $this->redirectToRoute('rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rapport/new.html.twig', [
            'rapport' => $rapport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rapport_show", methods={"GET"})
     */
    public function show(Rapport $rapport): Response
    {
        return $this->render('rapport/show.html.twig', [
            'rapport' => $rapport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rapport_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rapport $rapport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rapport = $form->getData();
            //Enregistrer des médicaments dans la table offrir pour chaque médicament contenu dans le rapport
            foreach($rapport->getOffrirs() as $offrir){
                $entityManager->persist($offrir);
            }

            $entityManager->flush();

            return $this->redirectToRoute('rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rapport/edit.html.twig', [
            'rapport' => $rapport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rapport_delete", methods={"POST"})
     */
    public function delete(Request $request, Rapport $rapport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rapport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rapport_index', [], Response::HTTP_SEE_OTHER);
    }
}
