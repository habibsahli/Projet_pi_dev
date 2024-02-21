<?php

namespace App\Controller;

use App\Entity\Typepack;
use App\Form\TypepackType;
use App\Repository\TypepackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/typepack')]
class TypepackController extends AbstractController
{
    #[Route('/', name: 'app_typepack_index', methods: ['GET'])]
    public function index(TypepackRepository $typepackRepository): Response
    {
        return $this->render('typepack/index.html.twig', [
            'typepacks' => $typepackRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_typepack_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $typepack = new Typepack();
        $form = $this->createForm(TypepackType::class, $typepack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typepack);
            $entityManager->flush();

            return $this->redirectToRoute('app_typepack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typepack/new.html.twig', [
            'typepack' => $typepack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typepack_show', methods: ['GET'])]
    public function show(Typepack $typepack): Response
    {
        return $this->render('typepack/show.html.twig', [
            'typepack' => $typepack,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_typepack_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Typepack $typepack): Response
    {
        $form = $this->createForm(TypepackType::class, $typepack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_typepack_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('typepack/edit.html.twig', [
            'typepack' => $typepack,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typepack_delete', methods: ['POST'])]
    public function delete(Request $request, Typepack $typepack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typepack->getIdTypepack(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typepack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_typepack_index', [], Response::HTTP_SEE_OTHER);
    }
}
