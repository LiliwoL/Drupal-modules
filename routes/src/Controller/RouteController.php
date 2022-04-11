<?php

namespace Drupal\routes\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends ControllerBase
{
    public function introduction()
    {
        // Controller doit renvoyer une réponse
        return new Response('Roaarr');
    }
}
