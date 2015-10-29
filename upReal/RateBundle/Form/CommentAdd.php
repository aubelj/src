<?php

namespace upReal\RateBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentAdd extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('commentary', 'text', array(
        	'label' => 'Commentaire',
        	'required' => true,
            'attr' => array('placeholder' => 'Commentaire')
        	));
        $builder->add('idTarget', 'hidden', array(
            'mapped' => false
            ));
        $builder->add('submit', 'submit', array(
            'label' => 'Ajouter'
            ));
    }

    public function getName()
    {
        return 'comment_add';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'upReal\RateBundle\Entity\Rate'
	        ));
	}
}