<?php

class FileDownload extends PluginFormatterBase {

  /**
   * {@inheritdoc}
   */
  function getName() {
    return 'file_download';
  }

 /**
 * {@inheritdoc}
 */
  function getInfo() {
    return array(
      'label' => t('Document download'),
      'field types' => array('file'),
    );
  }

  /**
   * {@inheritdoc}
   */
  function viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
    $element = array();
    foreach ($items as $delta => $item) {
      $element[$delta] = array(
        '#theme' => 'link',
        '#text' => t('Download it here!'),
        '#path' => file_create_url($item['uri']),
        '#options' => array(
          'attributes' =>array(
            'type' => $item['filemime'] . '; length=' . $item['filesize'],
          ),
        ),
      );
    }
    return $element;
  }

}
