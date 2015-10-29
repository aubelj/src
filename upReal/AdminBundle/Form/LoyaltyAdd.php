<?php

namespace upReal\AdminBundle\Form;

use upReal\CompanyBundle\Form\Type\CompanyType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoyaltyAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('front_cover', 'file', array(
        	'label' => 'Face avant',
        	'required' => true
        	));
        $builder->add('back_cover', 'file', array(
            'label' => 'Face arrière',
            'required' => true
            ));
        $builder->add('submit', 'submit', array(
            'label' => 'Ajouter'
            ));
    }

    public function getName()
    {
        return 'loyalty_add';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'upReal\UserBundle\Entity\Loyalty'
	        ));
	}
}