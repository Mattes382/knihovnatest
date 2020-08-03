<?php

namespace App\Form;

use App\Entity\Zanry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZanrAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nazev', TextType::class,[
                'label' => 'Název'
            ])
            ->add('upravit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Přidat žánr'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zanry::class,
        ]);
    }
}
