<?php

namespace Acme\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction(){
        return $this->render("ImageBundle::homepage.html.twig");
    }
}
