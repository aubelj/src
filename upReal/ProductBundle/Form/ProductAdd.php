<?php

namespace upReal\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
        	'label' => 'Libellé *',
        	'required' => true,
            'attr' => array('placeholder' => 'Dénomination du produit')
        	));
        $builder->add('brand', 'text', array(
            'label' => 'Société *',
            'required' => true,
            'attr' => array('placeholder' => 'Marque du produit')
            ));
        $builder->add('ean', 'text', array(
        	'label' => 'Code EAN *',
        	'required' => true,
            'attr' => array('placeholder' => 'Référence ou code barre')
        	));
        $builder->add('picture', 'file', array(
        	'label' => 'Image',
        	'required' => false // DEBUG
        	));
        $builder->add('submit', 'submit', array(
            'label' => 'Ajouter'
            ));
    }

    public function getName()
    {
        return 'product_add';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'upReal\ProductBundle\Entity\Product'
	        ));
	}
}