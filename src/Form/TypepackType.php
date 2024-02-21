<?php

namespace App\Form;

use App\Entity\Typepack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TypepackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomTypePack', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom de type de pack'
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s]+$/',
                        'message' => 'Le nom du type de pack ne peut contenir que des lettres, des chiffres et des espaces.'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Typepack::class,
        ]);
    }
}
