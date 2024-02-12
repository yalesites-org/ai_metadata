<?php

namespace Drupal\ai_metadata;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Utility\Token;
use Drupal\metatag\MetatagManager;

/**
 * Service for managing the AI Metadata module.
 */
class AiMetadataManager {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The token class.
   *
   * @var \Drupal\Core\Utility\Token
   */
  protected $token;

  /**
   * Metatag manager.
   *
   * @var \Drupal\metatag\MetatagManager
   */
  protected $metatagManager;

  /**
   * Constructs a new Sources object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   * @param \Drupal\metatag\MetatagManager $metatag_manager
   *   The metatag manager.
   * @param \Drupal\Core\Utility\Token $token
   *   The token class.
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    MetatagManager $metatag_manager,
    Token $token,
  ) {
    $this->entityTypeManager = $entityTypeManager;
    $this->metatagManager = $metatag_manager;
    $this->token = $token;
  }

  /**
   * Gets all custom AI metadata on an entity.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity to retrieve metadata from.
   *
   * @return array
   *   Metadata for specified entity.
   */
  public function getAiMetadata(ContentEntityInterface $entity) {
    $tags = $this->metatagManager->tagsFromEntity($entity);
    $aiDesc = isset($tags['ai_description']) ? $this->token->replace($tags['ai_description'], [$entity->getEntityTypeId() => $entity]) : "";
    $aiDisableIndex = isset($tags['ai_disable_indexing']) ? TRUE : FALSE;

    $metaData = [
      'ai_description' => $aiDesc,
      'ai_disable_index' => $aiDisableIndex,
    ];

    return $metaData;
  }

}
