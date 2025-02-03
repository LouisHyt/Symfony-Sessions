<?php

namespace App\Form;

use App\Entity\Intern;
use App\Entity\Session;
use App\Entity\Trainer;
use App\Entity\Training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('places', IntegerType::class, [
                'constraints' => [new Positive()],
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('beginDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('endDate',  DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('trainer', EntityType::class, [
                'class' => Trainer::class,
                'required'   => false,
                'choice_label' => 'fullname',
                'placeholder' => 'Select a trainer'
            ])
            ->add('confirm', SubmitType::class, [
                "attr" => [
                    "class" => "btn submit"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
            'attr' => ['class' => 'form']
        ]);
    }
}
