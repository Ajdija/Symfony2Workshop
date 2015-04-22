<?php

namespace Acme\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Form\ContactType;

class HomepageController extends Controller
{
    public function showAction()
    {
        return $this->render('ImageBundle::homepage.html.twig');
    }
}
