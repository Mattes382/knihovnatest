<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jmeno', TextType::class,[
                'label' => 'Celé jméno'
            ])
            ->add('Add', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Upravit autora'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
