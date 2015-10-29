<?php

namespace upReal\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address', 'textarea', array(
        	'label' => 'Adresse',
        	'required' => false,
        	));
        $builder->add('city', 'text', array(
        	'label' => 'Ville',
        	'required' => false
        	));
        $builder->add('postal_code', 'integer', array(
        	'label' => 'Code postal',
        	'required' => false,
        	));
        $builder->add('country', 'text', array(
            'label' => 'Pays',
            'required' => false
        	));
    }

    public function getName()
    {
        return 'address';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'upReal\CoreBundle\Entity\Address'
	        ));
	}
}