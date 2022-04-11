<?php

namespace Drupal\service\Service;

class MailerService
{
  public function sendMail( $to )
  {
    $sitename = \Drupal::config('system.site')->get('name');
    $langcode = \Drupal::config('system.site')->get('langcode');
    $reply = NULL;
    $send = TRUE;

    $params['message'] = t('Your wonderful message about @sitename', array('@sitename' => $sitename));
    $params['subject'] = t('Message subject');
    $params['options']['username'] = "Moi";
    $params['options']['title'] = t('Your wonderful title');
    $params['options']['footer'] = t('Your wonderful footer');


    $mailManager = \Drupal::service('plugin.manager.mail');
    $array = $mailManager->mail("routes", "key", $to, $langcode, $params, $reply, true);

    // Messenger Service
    \Drupal::messenger()->addStatus('show a status to the user.');

    return $array;
  }
}
