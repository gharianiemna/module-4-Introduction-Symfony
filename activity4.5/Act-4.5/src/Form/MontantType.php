<?php

namespace App\Form;

use App\Entity\Montant;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
class MontantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Montant', MoneyType::class,['required' => true,  'data' => 500, 'currency'=> 'USD' ])         
            ->add('Email',RepeatedType::class,['type'=>EmailType ::class,'first_options'  => ['label' => 'Email'],
            'second_options' => ['label' => 'Repeat Email'],'required' => true,'attr' => [
                'placeholder' => 'example@site.com'
                 ],
                 ])
            ->add('Mobile', TelType::class, [
                'required' => true,
                'constraints' => [new Length([
                    'min'=> 10,
                    'max'=> 10,
                    'exactMessage' => 'Votre numero doit faire 10 chiffres de long'
                ]),
                new Regex([
                    'pattern' => '/^0[67]/',
                    'message' => 'Le numero doit commencer par 06 ou 07'
                ])]
                 ])
            ->add('save', SubmitType::class, ['label' => 'Create Montant']); 
            }
            
    
        
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Montant::class,
        ]);
    }
}
