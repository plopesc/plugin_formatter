<?php

class TaxonomyTermNewsLink extends PluginFormatterBase {

  /**
   * {@inheritdoc}
   */
  function getName() {
    return 'taxonomy_term_reference_news_link';
  }

  /**
   * {@inheritdoc}
   */
  function getInfo() {
    return array(
      'label' => t('Link to news'),
      'field types' => array('taxonomy_term_reference'),
    );
  }

  /**
   * {@inheritdoc}
   */
  function viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
    $element = array();
    // Terms whose tid is 'autocreate' do not exist
    // yet and $item['taxonomy_term'] is not set. Theme such terms as
    // just their name.
    foreach ($items as $delta => $item) {
      if ($item['tid'] == 'autocreate') {
        $element[$delta] = array(
          '#markup' => check_plain($item['name']),
        );
      }
      else {
        $term = $item['taxonomy_term'];
        $element[$delta] = array(
          '#type' => 'link',
          '#title' => $term->name,
          '#href' => 'actualidad',
          '#options' => array(
            'query' => array(
              'tags' => $term->tid,
            ),
          ),
        );
      }
    }
    return $element;
  }

}
