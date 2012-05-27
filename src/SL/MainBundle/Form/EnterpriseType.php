<?php

namespace SL\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('statut', 'choice', array('choices' => array('waiting' => 'en attente', 'started' => 'en cours', 'completed' => 'terminé')))
            ->add('description', null, array('attr' => array('style' => 'width: 100%;', 'rows' => '10' )))
            ->add('start_date', null, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
            ->add('responsible', null, array('required' => false))
            ->add('groups', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'sl_mainbundle_enterprisetype';
    }
}
