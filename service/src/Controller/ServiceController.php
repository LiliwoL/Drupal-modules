<?php

namespace Drupal\routes\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\service\Service\MailerService;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends ControllerBase
{

  public function send()
  {
    $mailService = new MailService();
    $retour = $mailService->sendMail( "moi@campus-eni.fr" );

    dd($retour);

    return new Response("Coucou");
  }
}
