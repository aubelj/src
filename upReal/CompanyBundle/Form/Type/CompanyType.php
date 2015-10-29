<?php

namespace upReal\CompanyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'Nom de la société',
            'required' => 'true',
            ));
        $builder->add('website', 'text', array(
            'label' => 'Site web',
            'required' => false
            ));
        $builder->add('submit', 'submit', array(
            'label' => 'Ajouter'
            ));
    }

    public function getName()
    {
        return 'company_add';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'upReal\CompanyBundle\Entity\Company'
            ));
    }
}