<?php

namespace TEST\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TESTUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
