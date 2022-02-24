<?php

namespace App\Form;

use App\Entity\Reservas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha_inicio', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de inicio',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'La fecha de inicio debe de estar rellena'
                    ]),
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('fecha_fin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha fin',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'La fecha de inicio debe de estar rellena'
                    ]),
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('precio', MoneyType::class,[
                'disabled'=> true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Alquilar'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservas::class,
        ]);
    }
}
