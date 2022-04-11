# Drupal - Développement d'un module de block

## Create a module

To create a custom block, it is necessary to create a “.info.yml” file in modules/formation directory.
Here a formation directory does not exist.

Create a directory named “formation” under the module directory.

And under “modules/formation” create a directory called “block_example”.

This directory name will be the name of the module created.

Inside this folder that you just created, create a “<module name>.info.yml” file.

Here it will be block_example.info.yml as the module name is block_example.

Within this file, enter the following contents:

```yaml
name: Module de block
type: module
description: Un module de block
core_version_requirement: ^8 || ^9
package: formation
dependencies:
  - drupal:block
```

Activez le module.

##2. Classe Drupal Block

```php
<?php

namespace Drupal\block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *   id = 'simple_example_block',
 *   admin_label = @Translation("Simple Text Block")
 * )
 */
class JokeBlock extends BlockBase
{
  /**
   * @return string[]
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => "Un block Drupal"
    ];
  }
}
```

# 3. Activez le bloc et affichez le
