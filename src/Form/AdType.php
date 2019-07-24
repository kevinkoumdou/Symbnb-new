<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType {

    /**
     * Permet d'avoir la configuration de base d'un champ !
     * 
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     * 
     */
    private function getConfiguration($label, $placeholder, $options = []) {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
                ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, $this->getConfiguration("Titre", "Tapez un titre à votre annonce"))
                ->add('slug', TextType::class, $this->getConfiguration("Adresse web", "Tapez une adresse web (Pas obligatoire)", [
                            'required' => false
                        ])
                )
                ->add('coverImage', UrlType::class, $this->getConfiguration("Adresse image", "Saisissez l'adresse d'une image"))
                ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Tapez une introduction"))
                ->add('content', TextareaType::class, $this->getConfiguration("Description détaillée", "Ajouter une description détaillée"))
                ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Nombres de nuité"))
                ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", "Indiquez votre prix"))
                ->add('images',
                        CollectionType::class, [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                        ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }

}
