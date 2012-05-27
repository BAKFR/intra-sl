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
            ->add('description', null, array('attr' => array('style' => 'width: 100%;', 'rows' => '10' )))
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
