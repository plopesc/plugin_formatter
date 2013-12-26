<?php

include_once 'TaxonomyTermLinkBase.php';

class TaxonomyTermDocumentLink extends TaxonomyTermLinkBase {

  public function __construct() {
    $this->href = 'documentos-desarrolladores';
  }

  /**
   * {@inheritdoc}
   */
  function getName() {
    return 'taxonomy_term_reference_document_link';
  }

  /**
   * {@inheritdoc}
   */
  function getInfo() {
    return array(
      'label' => t('Link to document'),
      'field types' => array('taxonomy_term_reference'),
    );
  }

}
