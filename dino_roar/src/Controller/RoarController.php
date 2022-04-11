<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dino_roar\Service\RoarGenerator;
use Drupal\dino_roar\Service\RoarMail;
use Symfony\Component\HttpFoundation\Response;

class RoarController extends ControllerBase
{

    public function roar()
    {
        //dd('Rooooooaaaar');

        // Controller has to return a response!
        return new Response('ROOOOOAR');
    }

    public function roarRepeat(int $repeat)
    {
        $whatdinoSays = 'R' . str_repeat('0', $repeat) . 'AR';

        // Controller has to return a response!
        return new Response($whatdinoSays);
    }

    public function roarSomething(string $something)
    {
        //dd('Rooooooaaaar');

        // Controller has to return a response!
        return new Response('ROOOOOAR ' . $something);
    }

    public function roarRepeatWithService(int $repeat)
    {
        // Appel du service RoarGenerator
        // Attention au use qui doit figurer en haut du fichier!
        $roarGenerator = new RoarGenerator();

        $roar = $roarGenerator->generateRoar($repeat);

        // Controller has to return a response!
        return new Response($roar);
    }
}