<?php

namespace App\Controller;
use App\Entity\Typepack;
use App\Entity\Packpersonnalise;
use App\Form\PackpersonnaliseType;
use App\Repository\PackpersonnaliseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\Extension\Core\Type\FileType;

#[Route('/packpersonnalise')]
class PackpersonnaliseController extends AbstractController
{

    #[Route('/', name: 'app_packpersonnalise_index', methods: ['GET'])]
    public function index(PackpersonnaliseRepository $packpersonnaliseRepository): Response
    {
        return $this->render('packpersonnalise/index.html.twig', [
            'packpersonnalises' => $packpersonnaliseRepository->findAll(),
        ]);
    }


    

    #[Route('/new', name: 'app_packpersonnalise_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag): Response
{
    // Récupérer tous les types de pack disponibles depuis la base de données
    $typesDePack = $this->getDoctrine()->getRepository(Typepack::class)->findAll();

    // Créer le formulaire
    $packpersonnalise = new Packpersonnalise();
    // Créez le formulaire en passant l'instance de Packpersonnalise
$form = $this->createForm(PackpersonnaliseType::class, $packpersonnalise, ['types' => $typesDePack]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Récupérer le type de pack sélectionné
        $typePackSelectionne = $form->get('Type_pack')->getData();

        // Utiliser le type de pack pour mettre à jour le pack personnalisé
        $this->updatePackPersonnaliseWithTypePack($packpersonnalise, $typePackSelectionne);

        // Obtenez le répertoire d'images à partir du conteneur de paramètres
        $imagesDirectory = $parameterBag->get('kernel.project_dir') . '/public/uploads/images';

        // Traitement de l'image téléchargée
        $imageFile = $form->get('Image')->getData();

        if ($imageFile) {
            $imageName = uniqid().'.'.$imageFile->guessExtension();
            $imageFile->move($imagesDirectory, $imageName);

            // Assignation de l'emplacement de l'image à l'entité
            $packpersonnalise->setImage($imageName);
        }

        // Persist et flush de l'entité dans la base de données
        $entityManager->persist($packpersonnalise);
        $entityManager->flush();

        return $this->redirectToRoute('app_packpersonnalise_index');
    }

    return $this->renderForm('packpersonnalise/new.html.twig', [
        'packpersonnalise' => $packpersonnalise,
        'form' => $form,
    ]);
}
    private function updatePackPersonnaliseWithTypePack(Packpersonnalise $packpersonnalise, Typepack $typepack)
    {
        // Mettre à jour les propriétés du pack personnalisé en fonction du type de pack sélectionné
        $packpersonnalise->setTypePack($typepack);
    
        // Autres mises à jour du pack personnalisé si nécessaire
    }
    


    #[Route('/{id}', name: 'app_packpersonnalise_show', methods: ['GET'])]
    public function show(Packpersonnalise $packpersonnalise): Response
    {
        return $this->render('packpersonnalise/show.html.twig', [
            'packpersonnalise' => $packpersonnalise,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_packpersonnalise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Packpersonnalise $packpersonnalise): Response
    {
        // Récupérer tous les types de pack depuis la base de données
        $typesDePack = $this->getDoctrine()->getRepository(Typepack::class)->findAll();
    
        // Créer le formulaire et passer les types de pack en option
        $form = $this->createForm(PackpersonnaliseType::class, $packpersonnalise, [
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
                    $packpersonnalise->setImage($newFilename); // Définir le nom du fichier dans l'entité
                } catch (FileException $e) {
                    // Gérer l'exception si le déplacement du fichier a échoué
                }
            }
    
            // Enregistrer les modifications dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
    
            return $this->redirectToRoute('app_packpersonnalise_index', [], Response::HTTP_SEE_OTHER);
        }
    
        // Rendre le formulaire dans le template
        return $this->render('packpersonnalise/edit.html.twig', [
            'packpersonnalise' => $packpersonnalise,
            'form' => $form->createView(),
        ]);
    }
    



    #[Route('/{id}', name: 'app_packpersonnalise_delete', methods: ['POST'])]
    public function delete(Request $request, Packpersonnalise $packpersonnalise, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packpersonnalise->getId_Packperso(), $request->request->get('_token'))) {
            $entityManager->remove($packpersonnalise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_packpersonnalise_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
