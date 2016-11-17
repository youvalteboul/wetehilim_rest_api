<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Pas besoin de rajouter les options avec ChoiceType vu que nous allons l'utiliser via API.
        // Le formulaire ne sera jamais affiché
        $builder->add('type');
        $builder->add('value');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Price',
            'csrf_protection' => false
        ]);
    }
}