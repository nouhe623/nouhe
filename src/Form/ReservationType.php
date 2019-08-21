<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class ReservationType extends AbstractType
{
    private $transformer;

     


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('startDate', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd',))
            ->add('endDate', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd'))
            ->add('createdAt')
            ->add('nombre', IntegerType::class, array('required' => true))
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('sexe')
            ->add('pays')
            ->add('ville')
            ->add('comment')
            ->add('hotel')
        ;
     }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'validation_groups' => [
                'Default',
                'front'
            ]
        ]);
    }
}
