<?php

namespace Drupal\dino_roar\Service;

/**
 * Service RoarGenerator
 *
 * You can check it works by typing
 * drupal debug:container | grep dino (if enabled in services.yml)
 */
class RoarGenerator
{
    public function generateRoar($count)
    {
        $whatdinoSays = 'R' . str_repeat('0', $count) . 'AR but as a service!';

        // Controller has to return a response!
        return $whatdinoSays;
    }
}