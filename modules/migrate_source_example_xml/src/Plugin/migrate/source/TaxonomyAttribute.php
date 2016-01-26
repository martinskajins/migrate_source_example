<?php

/**
 * @file
 * Contains \Drupal\migrate_source_example_xml\Plugin\migrate\source\TaxonomyAttribute.
 */

namespace Drupal\migrate_source_example_xml\Plugin\migrate\source;

use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate_source_xml\Plugin\migrate\source\XmlBase;

/**
 * Taxonomy attribute migration.
 *
 * @MigrateSource(
 *   id = "migrate_source_example_xml_taxonomy_attribute"
 * )
 */
class TaxonomyAttribute extends XmlBase {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration, array $namespaces = []) {
    $module_path = drupal_get_path('module', 'migrate_source_example_xml');

    // Set absolute file to the source files.
    foreach ($configuration['urls'] as &$url) {
      $url = DRUPAL_ROOT . '/' . $module_path . '/' . $url;
    }

    // Set iterator class.
    $configuration['iterator_class'] = $this->getIteratorClassName();

    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration);
  }

  /**
   * Returns XML iterator class name.
   *
   * @return string
   */
  protected function getIteratorClassName() {
    return 'Drupal\migrate_source_example_xml\Plugin\migrate\source\MigrateExampleXmlIterator';
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [];

    if (!empty($this->configuration['fields'])) {
      $fields = $this->configuration['fields'] + $fields;
    }

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids = [];
    foreach ($this->configuration['keys'] as $key) {
      $ids[$key]['type'] = 'string';
    }
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    $class = $this->getIteratorClassName();
    /** @var MigrateExampleXmlIterator $iterator */
    $iterator = new $class($this);
    $iterator->rewind();

    $count = 0;
    while ($iterator->valid()) {
      $count++;
      $iterator->next();
    }

    return $count;
  }

}
