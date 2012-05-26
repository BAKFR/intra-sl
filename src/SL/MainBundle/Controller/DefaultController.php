<?php

namespace SL\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('SLMainBundle:Default:index.html.twig', array('name' => 'guest'));
    }
}
