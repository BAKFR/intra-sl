<?php

namespace SL\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TestType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('start_date', null, array('widget' => 'single_text'))
            ->add('stop_date', null, array('widget' => 'single_text'))
            ->add('title')
            ->add('corps', null, array('attr' => array('style' => 'width: 100%;', 'rows' => '10' )))
            ->add('authors')
//            ->add('enterprise', null, array(/*'disabled' => true*/))
        ;
    }

    public function getName()
    {
        return 'sl_mainbundle_testtype';
    }
}
