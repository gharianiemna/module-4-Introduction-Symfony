<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\GreaterThan;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nom', TextType::class, ['required' => true])
        ->add('Prenom', TextType::class,  ['required' => true])
        ->add('Age', TextType::class, ['required' => false])
        ->add('Adress', TextType::class,  ['required' => true], ['attr' => ['maxlength' => 255]])
        ->add('CodPostal', NumberType::class, [
            'required' => true,
            'constraints' => [new LessThan([
                'value' => 100000,
                'message' => 'Le code postal doit être une valeur de 5 chiffres'
            ]),
            new GreaterThan([
                'value' => 9999,
                'message' => 'Le code postal doit être une valeur de 5 chiffres'
            ])]
        ])
        ->add('Ville', TextType::class,  ['required' => true])
        ->add('PermisConduire',  ChoiceType::class, [
            'choices' => [
                '' => false,
                'AM' => 'AM',
                'A1'=> 'A1',
                'A2'=> 'A2' ,
                'A'=> 'A',
                'B1'=> 'B1',
                'B' =>   'B' 
            ]])

        ->add('save', SubmitType::class, ['label' => 'Create User'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
