<?php

namespace upReal\UserBundle\Form\Type;

use upReal\CoreBundle\Form\Type\AddressType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array(
            'label' => 'Nom d\'utilisateur',
            'required' => 'true',
            ));
        $builder->add('firstname', 'text', array(
            'label' => 'Prénom',
            'required' => false
            ));
        $builder->add('lastname', 'text', array(
            'label' => 'Nom',
            'required' => false
            ));
        $builder->add('email', 'email', array(
            'required' => 'true'
            ));
        $builder->add('password', 'password', array(
            'label' => 'Mot de passe',
            'required' => false
            ));
        $builder->add('phone', 'text', array(
            'label' => 'Téléphone',
            'required' => false
            ));
        $builder->add('address', new AddressType());
        $builder->add('submit_inscription', 'submit', array(
            'label' => 'Inscription'
            ));
        $builder->add('submit_edit', 'submit', array(
            'label' => 'Modifier'
            ));
        $builder->add('submit_login', 'submit', array(
            'label' => 'Se connecter'
            ));
    }

    public function getName()
    {
        return 'user_inscription';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'upReal\UserBundle\Entity\User'
            ));
    }
}