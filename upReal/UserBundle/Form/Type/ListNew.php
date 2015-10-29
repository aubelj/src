<?php

namespace upReal\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListNew extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, $path = NULL)
    {
        if (!empty($path))
            $builder->setAction($path);
        $builder->add('name', 'text', array(
            'label' => 'Nom',
            'required' => true
        ));
        $builder->add('public', 'choice', array(
            'choices'   => array(
                '1' => 'Publique',
                '0' => 'Privée',
            ),
            'label' => false,
            'required' => true
        ));
    }

    public function getName()
    {
        return 'list_new';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'upReal\UserBundle\Entity\Lists'
            ));
    }
}