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
