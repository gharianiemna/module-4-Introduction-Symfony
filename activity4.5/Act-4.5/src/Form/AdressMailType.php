<?php

namespace App\Form;

use App\Entity\AdressMail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdressMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail', RepeatedType::class,['type'=>EmailType ::class,'first_options'  => ['label' => 'Email'],
            'second_options' => ['label' => 'Repeat Email'],'required' => true,'attr' => [
                'placeholder' => 'example@site.com'
                 ],
                 ])
                 ->add('save', SubmitType::class, ['label' => 'Create Email']); 
                
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdressMail::class,
        ]);
    }
}
