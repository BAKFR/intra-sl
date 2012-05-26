<?php

namespace SL\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkGroupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('leader')
            ->add('members', null, array('required' => false))
            ->add('enterprises', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'sl_mainbundle_workgrouptype';
    }
}
