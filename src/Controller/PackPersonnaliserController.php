<?php

namespace App\Controller;

use App\Entity\PackPersonnaliser;
use App\Form\PackPersonnaliserType;
use App\Repository\PackPersonnaliserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/packpersonnaliser')]
class PackPersonnaliserController extends AbstractController
{
    #[Route('/', name: 'app_pack_personnaliser_index', methods: ['GET'])]
    public function index(PackPersonnaliserRepository $packPersonnaliserRepository): Response
    {
        return $this->render('pack_personnaliser/index.html.twig', [
            'pack_personnalisers' => $packPersonnaliserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pack_personnaliser_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $packPersonnaliser = new PackPersonnaliser();
        $form = $this->createForm(PackPersonnaliserType::class, $packPersonnaliser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($packPersonnaliser);
            $entityManager->flush();

            return $this->redirectToRoute('app_pack_personnaliser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pack_personnaliser/new.html.twig', [
            'pack_personnaliser' => $packPersonnaliser,
            'form' => $form,
        ]);
    }

    #[Route('/{idPackPersonnaliser}', name: 'app_pack_personnaliser_show', methods: ['GET'])]
    public function show(PackPersonnaliser $packPersonnaliser): Response
    {
        return $this->render('pack_personnaliser/show.html.twig', [
            'pack_personnaliser' => $packPersonnaliser,
        ]);
    }

    #[Route('/{idPackPersonnaliser}/edit', name: 'app_pack_personnaliser_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PackPersonnaliser $packPersonnaliser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PackPersonnaliserType::class, $packPersonnaliser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pack_personnaliser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pack_personnaliser/edit.html.twig', [
            'pack_personnaliser' => $packPersonnaliser,
            'form' => $form,
        ]);
    }

    #[Route('/{idPackPersonnaliser}', name: 'app_pack_personnaliser_delete', methods: ['POST'])]
    public function delete(Request $request, PackPersonnaliser $packPersonnaliser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packPersonnaliser->getIdPackPersonnaliser(), $request->request->get('_token'))) {
            $entityManager->remove($packPersonnaliser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pack_personnaliser_index', [], Response::HTTP_SEE_OTHER);
    }
}
