<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PsalmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number');
        $builder->add('numberHebrew');
        $builder->add('meaning');
        $builder->add('timing');
        $builder->add('readingDay');
        $builder->add('theme');
        $builder->add('tags');
        $builder->add('verses', CollectionType::class, [
            'entry_type' => VerseType::class,
            'allow_add' => true,
            'error_bubbling' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Psalm',
            'csrf_protection' => false
        ]);
    }
}
