<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Joueur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nomequipe',textType::class,['required' => true])
            ->add('Ville',textType::class,['required' => true])
            ->add('Sport',ChoiceType::class, [
                'choices' => [
                    'Football' => 1,
                    'Handball' => 2,
                    'Tennis' => 3,
                    'Rugby' => 4, 
                    'Volleyball' => 5, 
                    'Bascketball' => 6, 
                    'Hokey' => 7,
                ],'required' => true],)
            ->add('joueur',JoueurType::class)
            ->add('valider', SubmitType::class);
        }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
