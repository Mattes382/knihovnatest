<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Knihy;
use App\Entity\Zanry;
use App\Repository\AuthorRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Image;

class KnihaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazev', TextType::class,[
                'label' => 'Název'
            ])
            ->add('author', EntityType::class,[
                'class' => Author::class,
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('a')->orderBy('a.jmeno', 'ASC');
                }
            ])
            ->add('rokvydani', IntegerType::class,[
                'label' => 'Rok vydání'
            ])
            ->add('pocetstranek', IntegerType::class,[
                'label' => 'Počet stránek'
            ])
            ->add('zanry', EntityType::class,[
                'class' => Zanry::class,
                'multiple' => true,
                'label' => 'Žánry'
            ])
            ->add('detail', TextareaType::class,[
                'label' => 'Detail'
            ])
            ->add('obrazek', FileType::class, [
                'label' => 'Obrázek',
                'mapped' => false,

            ])
            ->add('Add', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ],
                'label' => 'Přidat novou knihu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Knihy::class,
        ]);
    }
}
