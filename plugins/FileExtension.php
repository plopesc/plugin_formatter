<?php

class FileExtension extends PluginFormatterBase {

  /**
   * {@inheritdoc}
   */
  function getName() {
    return 'file_extension';
  }

  /**
   * {@inheritdoc}
   */
  function getInfo() {
    return array(
      'label' => t('Document extension'),
      'field types' => array('file'),
    );
  }

  /**
   * {@inheritdoc}
   */
  function viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
    $element = array();
    foreach ($items as $delta => $item) {
      $ext = pathinfo($item['filename'], PATHINFO_EXTENSION);
      $element[$delta] = array(
        '#markup' => $ext,
      );
    }
    return $element;
  }

}
