<?php

class TextStubBodyTitle extends PluginFormatterBase {

  /**
   * {@inheritdoc}
   */
  function getName() {
    return 'text_stub_body_title';
  }

  /**
   * {@inheritdoc}
   */
  function getInfo() {
    return array(
      'label' => t('Stub title'),
      'field types' => array('text',),
    );
  }

  /**
   * {@inheritdoc}
   */
  function viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
    $element = array();

    $nid = field_collection_item_get_host_entity($entity)->nid->value();
    foreach ($items as $delta => $item) {
      $output = _text_sanitize($instance, $langcode, $item, 'value');
      $element[$delta] = array('#markup' => l($output, "node/$nid", array('fragment' => $entity->delta)));
    }

    return $element;
  }

}