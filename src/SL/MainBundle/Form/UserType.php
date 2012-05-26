<?php

namespace SL\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('login_intra')
            ->add('login')
            ->add('password', 'password')
            ->add('creation_date', null, array('widget' => 'single_text'))
            ->add('statut', 'choice', array('choices' => array('member' => 'membre', 'admin' => 'admin', 'disabled' => 'désactivé')))
            ->add('groups', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'sl_mainbundle_usertype';
    }
}
