<?php

// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{

  public function showAction()
  {
    $content = $this->get('templating')->render('AppBundle:defaults:index.html.twig');
    return new Response($content);
  }
}
