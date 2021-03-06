<?php

class ImageTitlePlugin extends PluginFormatterBase {

  function getName() {
    return 'image_title';
  }

  /**
   * {@inheritdoc}
   */
  function getInfo() {
    return array(
      'label' => t('Image with title'),
      'field types' => array('image'),
      'settings' => array('image_style' => '', 'image_link' => ''),
    );
  }

  /**
   * {@inheritdoc}
   */
  function getDependency() {
    return 'image';
  }

  /**
   * {@inheritdoc}
   */
  function settingsForm($field, $instance, $view_mode, $form, &$form_state) {
    $display = $instance['display'][$view_mode];
    $settings = $display['settings'];

    $image_styles = image_style_options(FALSE, PASS_THROUGH);
    $element['image_style'] = array(
      '#title' => t('Image style'),
      '#type' => 'select',
      '#default_value' => $settings['image_style'],
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
    );

    $link_types = array(
      'content' => t('Content'),
      'file' => t('File'),
    );
    $element['image_link'] = array(
      '#title' => t('Link image to'),
      '#type' => 'select',
      '#default_value' => $settings['image_link'],
      '#empty_option' => t('Nothing'),
      '#options' => $link_types,
    );
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  function settingsSummary($field, $instance, $view_mode) {
    $display = $instance['display'][$view_mode];
    $settings = $display['settings'];

    $image_styles = image_style_options(FALSE, PASS_THROUGH);
    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    if (isset($image_styles[$settings['image_style']])) {
      $summary[] = t('Image style: @style', array('@style' => $image_styles[$settings['image_style']]));
    }
    else {
      $summary[] = t('Original image');
    }

    $link_types = array(
      'content' => t('Linked to content'),
      'file' => t('Linked to file'),
    );
    // Display this setting only if image is linked.
    if (isset($link_types[$settings['image_link']])) {
      $summary[] = $link_types[$settings['image_link']];
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  function viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display) {
    $element = array();
    // Check if the formatter involves a link.
    if ($display['settings']['image_link'] == 'content') {
      $uri = entity_uri($entity_type, $entity);
    }
    elseif ($display['settings']['image_link'] == 'file') {
      $link_file = TRUE;
    }

    foreach ($items as $delta => $item) {
      if (isset($link_file)) {
        $uri = array(
          'path' => file_create_url($item['uri']),
          'options' => array(),
        );
      }
      $element[$delta] = array(
        array(
          '#theme' => 'image_formatter',
          '#item' => $item,
          '#image_style' => $display['settings']['image_style'],
          '#path' => isset($uri) ? $uri : '',
        )
      );
      if (isset($item['title']) && drupal_strlen($item['title']) > 0) {
        $element[$delta][] = array(
          '#markup' => $item['title'],
          '#prefix' => '<span class="footer-img">',
          '#suffix' => '</span>',
        );
      }
    }

    return $element;
  }

}
