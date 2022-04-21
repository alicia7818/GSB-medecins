<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Rapport;
use App\Form\MedecinType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medecin")
 */
class MedecinController extends AbstractController
{
    /**
     * @Route("/", name="medecin_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $medecins = $entityManager
            ->getRepository(Medecin::class)
            ->findAll();
        return $this->render('medecin/index.html.twig', [
            'medecins' => $medecins,
        ]);
    }

    /**
     * @Route("/new", name="medecin_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($medecin);
            $entityManager->flush();

            return $this->redirectToRoute('medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/new.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="medecin_show", methods={"GET"})
     */
    public function show(Medecin $medecin, EntityManagerInterface $entityManager, $id): Response
    {
        $rapports = $entityManager
            ->getRepository(Rapport::class)
            ->findByMedecin($id);
        return $this->render('medecin/show.html.twig', [
            'medecin' => $medecin,
            'rapports' => $rapports,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medecin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Medecin $medecin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="medecin_delete", methods={"POST"})
     */
    public function delete(Request $request, Medecin $medecin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($medecin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medecin_index', [], Response::HTTP_SEE_OTHER);
    }
}
