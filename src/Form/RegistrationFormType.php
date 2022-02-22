<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Correo',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo email debe de estar relleno',
                    ]),
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'required'=>true,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'El campo nombre debe de estar relleno',
                    ]),
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo apellidos debe de estar relleno',
                    ]),
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('foto', FileType::class, [
                'label' => 'Foto',
                'attr' => [
                    'class' => 'input-control'
                ],
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '1024k',
                    ])
                ]
            ])
            ->add('fecha_nac', DateType::class, [
                'widget'=>'single_text',
                'label' => 'Fecha de nacimiento',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes elegir una fecha',
                    ]),
                ],
                
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Acepta los términos',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes de aceptar los términos',
                    ]),
                ],
            ])
            /*->add('plainPassword', PasswordType::class,[
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor inserte',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Tu contraseña debe de tener al menos 6',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                
            ])*/
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Deben coincidir las contraseñas.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options' => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Repite la contraseña']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Registrar'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
