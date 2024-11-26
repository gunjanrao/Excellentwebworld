<?php

namespace Drupal\contract\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block for displaying contracts.
 *
 * @Block(
 *   id = "contract_block",
 *   admin_label = @Translation("Contract Block")
 * )
 */
class ContractBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new ContractBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Load nodes of type 'contract'.
    $query = $this->entityTypeManager
      ->getStorage('node')
      ->loadByProperties(['type' => 'contract']);

    $contracts = [];
    foreach ($query as $node) {
      $contracts[] = [
        'title' => $node->label(),
        'date' => $node->get('field_date')->value,
        'sender' => $node->get('field_sender_name')->value,
        'recipient' => $node->get('field_recipient_name')->value,
      ];
    }

    $build = [
      '#theme' => 'contract_list',
      '#contracts' => $contracts,
    ];

    // Apply cache metadata for the block.
    $cache_metadata = new CacheableMetadata();
    $cache_metadata->setCacheTags(['node_list:contract']);
    $cache_metadata->applyTo($build);

    return $build;
  }

}
