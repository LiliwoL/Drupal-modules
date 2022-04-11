## Envoi de mail avec Mail Manager

L'envoi de mail avec Drupal est en 2 étapes:
* Définir les propriétés de l'email (sujet, body, headers, etc.) avec un **hook_mail** appoprié
* Utiliser le Mail Manager pour envoyer le mail

# Etape 1

````php
<?php

/**
* Implements hook_mail().
*/
function <module_name>_mail($key, &$message, $params) {
   $options = array(
     'langcode' => $message['langcode'],
   );

    // On pourrait vérifier la clé pour plus de sécurité
    switch ($key) {
        case 'create_article':
        default: // A retirer pour plus de sécurité
         $message['from'] = \Drupal::config('system.site')->get('mail');
         $message['subject'] = t('Article created: @title', array('@title' => $params['node_title']), $options);
         $message['body'][] = $params['message'];
         break;
    }
 }
?>
````

This is a simple implementation that defines one template identified as test_message (the $key).
The other two function arguments are:
* $message: passed by reference, and inside which we add as much boilerplate about our email as we need
* $params: an array of extra data that needs to go in the email and that is passed from the mail manager when we try to send the email

## Etape 2: Mail Manager

```php
<?php
/**
* Implements hook_entity_insert().
*/
function <module_name>_entity_insert(Drupal\Core\Entity\EntityInterface $entity) {

 if ($entity->getEntityTypeId() !== 'node' || ($entity->getEntityTypeId() === 'node' && $entity->bundle() !== 'article')) {
   return;
 }
 $mailManager = \Drupal::service('plugin.manager.mail');
 $module = ‘<module_name>’;
 $key = 'create_article';
 $to = \Drupal::currentUser()->getEmail();
 $params['message'] = $entity->get('body')->value;
 $params['node_title'] = $entity->label();
 $langcode = \Drupal::currentUser()->getPreferredLangcode();
 $send = true;

 $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
 if ($result['result'] !== true) {
   drupal_set_message(t('There was a problem sending your message and it was not sent.'), 'error');
 }
 else {
   drupal_set_message(t('Your message has been sent.'));
 }

}
?>
```

This will gets triggered every time any Article will be created.

Every time when we will create any Article, we load the Drupal Mail manager service and start setting values for email.

We need the following information:

* $module : the module name that implements hook_mail() and defines our template
* $key : the template id
* $to :the recipient email address (the one found on the current user account)
* $langcode :the language which goes inside the $params array and which will be used to translate the subject message
* $params['subject'] : email subject
* $params['message'] the email body
* $send : the boolean value indicating whether the email should be actually sent

We then pass all these values to the mail() method of the mail manager. The latter is responsible for building the email (calling the right hook_mail() implementation being one aspect of this) and finally delegating the actual delivery to the responsible plugin. By default, this will be PHPMail, which uses the default mail() function that comes with PHP.
And this is all about sending emails programmatically using Drupal 8. We have seen the steps required to send email programmatically by the mail manager whenever we want it. We have also mentioned the default mail delivery plugin which is used to send emails in Drupal 8.
