<?php

namespace App\Controller;

use App\Entity\Requete;
use App\Form\RequeteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/requete')]
final class RequeteController extends AbstractController{
    #[Route(name: 'app_requete_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $requetes = $entityManager
            ->getRepository(Requete::class)
            ->findAll();

        return $this->render('requete/index.html.twig', [
            'requetes' => $requetes,
        ]);
    }

    #[Route('/new', name: 'app_requete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $requete = new Requete();
        $form = $this->createForm(RequeteType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($requete);
            $entityManager->flush();

            return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('requete/new.html.twig', [
            'requete' => $requete,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_requete_show', methods: ['GET'])]
    public function show(Requete $requete): Response
    {
        return $this->render('requete/show.html.twig', [
            'requete' => $requete,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_requete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Requete $requete, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RequeteType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('requete/edit.html.twig', [
            'requete' => $requete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_requete_delete', methods: ['POST'])]
    public function delete(Request $request, Requete $requete, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$requete->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($requete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_requete_index', [], Response::HTTP_SEE_OTHER);
    }
}
