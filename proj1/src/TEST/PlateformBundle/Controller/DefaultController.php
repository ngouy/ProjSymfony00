<?php

namespace TEST\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TESTPlateformBundle:Default:index.html.twig', array('name' => $name));
    }
}
