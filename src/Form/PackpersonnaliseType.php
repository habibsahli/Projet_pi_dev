<?php

namespace App\Form;

use App\Entity\PackPersonnalise; // Utilisation de la bonne casse
use App\Entity\Typepack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\File;
class PackpersonnaliseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_packperso', TextType::class, [
                'label' => 'Nom du pack',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ]
            ])
            ->add('Type_pack', ChoiceType::class, [
                'label' => 'Type de pack',
                'choices' => $options['types'],
                'choice_label' => function (Typepack $typepack) {
                    return $typepack->getNomTypePack();
                },
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('Description_pack', TextareaType::class, [
                'label' => 'Description du pack',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('Prix', MoneyType::class, [
                'label' => 'Prix',
                'constraints' => [
                    new NotBlank(),
                    new GreaterThanOrEqual(0),
                ]
            ])
            ->add('Date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'html5' => true,
                'data' => new \DateTime(),
                'constraints' => [
                    new NotBlank(),
                    // Ajoutez d'autres contraintes de validation au besoin
                ],
            ])
            ->add('Image', FileType::class, [
                'label' => 'Image (JPEG/PNG files)',
                'required' => false, // le champ n'est pas requis
                'mapped' => false, // ne pas mapper ce champ à l'entité
                'multiple' => false, // autoriser uniquement un fichier à être téléchargé
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Packpersonnalise::class,
            'types' => [], // Définit une option 'types' par défaut comme un tableau vide
        ]);
}
}