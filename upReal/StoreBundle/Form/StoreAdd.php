<?php

namespace upReal\StoreBundle\Form;

use upReal\CoreBundle\Form\Type\AddressType;
use upReal\CompanyBundle\Form\Type\CompanyType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoreAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
        	'label' => 'Nom',
        	'required' => true
        	));
        $builder->add('website', 'text', array(
            'label' => 'Site web',
            'required' => false
            ));
        $builder->add('address', new AddressType());
        $builder->add('company', new CompanyType());
        $builder->add('submit', 'submit', array(
            'label' => 'Ajouter'
            ));
    }

    public function getName()
    {
        return 'store_add';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'upReal\StoreBundle\Entity\Store'
	        ));
	}
}