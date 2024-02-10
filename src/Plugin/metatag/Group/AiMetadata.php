<?php

namespace Drupal\ai_metadata\Plugin\metatag\Group;

use Drupal\metatag\Plugin\metatag\Group\GroupBase;

/**
 * The AI metadata group.
 *
 * @MetatagGroup(
 *   id = "ai_metadata",
 *   label = @Translation("AI Metadata"),
 *   description = @Translation("AI specific metatags"),
 *   weight = -9
 * )
 */
class AiMetadata extends GroupBase {
  // Inherits everything from Base.
}
