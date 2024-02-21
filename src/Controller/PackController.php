<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Form\PackType;
use App\Repository\PackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Typepack; // Importez l'entité Typepack

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
#[Route('/pack')]
class PackController extends AbstractController
{
    #[Route('/', name: 'app_pack_index', methods: ['GET'])]
    public function index(PackRepository $packRepository): Response
    {
        return $this->render('pack/index.html.twig', [
            'packs' => $packRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pack_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag): Response
    {
        // Récupérer tous les types de pack disponibles depuis la base de données
        $typesDePack = $this->getDoctrine()->getRepository(Typepack::class)->findAll();
    
        // Créer le formulaire
        $pack = new Pack();
        // Créez le formulaire en passant l'instance de Pack
        $form = $this->createForm(PackType::class, $pack, ['types' => $typesDePack]);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le type de pack sélectionné
            $typePackSelectionne = $form->get('Type_pack')->getData();
    
            // Utiliser le type de pack pour mettre à jour le pack personnalisé
            $this->updatePackWithTypePack($pack, $typePackSelectionne);
    
            // Obtenez le répertoire d'images à partir du conteneur de paramètres
            $imagesDirectory = $parameterBag->get('kernel.project_dir') . '/public/uploads/images';
    
            // Traitement de l'image téléchargée
            $imageFile = $form->get('Image')->getData();
    
            if ($imageFile) {
                $imageName = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move($imagesDirectory, $imageName);
    
                // Assignation de l'emplacement de l'image à l'entité
                $pack->setImage($imageName);
            }
    
            // Persist et flush de l'entité dans la base de données
            $entityManager->persist($pack);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_pack_index');
        }
    
        return $this->renderForm('pack/new.html.twig', [
            'pack' => $pack, // Correction ici, 'pack' au lieu de 'packs'
            'form' => $form,
        ]);
    }
    private function updatePackWithTypePack(PacK $pack, Typepack $typepack)
    {
        // Mettre à jour les propriétés du pack personnalisé en fonction du type de pack sélectionné
        $pack->setTypePack($typepack);
    
        // Autres mises à jour du pack personnalisé si nécessaire
    }


    #[Route('/{id}', name: 'app_pack_show', methods: ['GET'])]
    public function show(Pack $pack): Response
    {
        return $this->render('pack/show.html.twig', [
            'pack' => $pack,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pack_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Pack $pack): Response
{
    // Récupérer tous les types de pack depuis la base de données
    $typesDePack = $this->getDoctrine()->getRepository(Typepack::class)->findAll();

    // Créer le formulaire et passer les types de pack en option
    $form = $this->createForm(PackType::class, $pack, [
        'types' => $typesDePack,
    ]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Récupérer le fichier d'image soumis
        $imageFile = $form->get('Image')->getData();

        if ($imageFile) {
            // Déplacer le fichier téléchargé vers le répertoire souhaité
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/images';
            $newFilename = uniqid().'.'.$imageFile->guessExtension();

            try {
                $imageFile->move($destination, $newFilename);
                $pack->setImage($newFilename); // Définir le nom du fichier dans l'entité
            } catch (FileException $e) {
                // Gérer l'exception si le déplacement du fichier a échoué
            }
        }

        // Enregistrer les modifications dans la base de données
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
    }

    // Rendre le formulaire dans le template
    return $this->render('pack/edit.html.twig', [
        'pack' => $pack,
        'form' => $form->createView(),
    ]);
}


    #[Route('/{id}', name: 'app_pack_delete', methods: ['POST'])]
    public function delete(Request $request, Pack $pack, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pack->getId_pack(), $request->request->get('_token'))) {
            $entityManager->remove($pack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pack_index', [], Response::HTTP_SEE_OTHER);
    }
}
