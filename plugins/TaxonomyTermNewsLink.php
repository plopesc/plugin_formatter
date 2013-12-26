<?php

include_once 'TaxonomyTermLinkBase.php';

class TaxonomyTermNewsLink extends TaxonomyTermLinkBase {

  public function __construct() {
    $this->href = 'actualidad';
  }

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

}
