plugin_formatter
================

Pseudo plugin manager for Drupal 7 Field formatters.

It provides an API similar to D8 FormatterInterface.

Included plugins
================
* FileDownload: Provides a download link for file fields.
* FileExtension: Provides an extension formatter for file fields.
* ImageTitlePlugin: Provides a formtter for image field qhere the image title is displayed below.


PluginFormatter API
===================

* getName(): The plugin name.
* getInfo(): The plugin info, as provided in hook_field_formatter_info().
* settingsForm($field, $instance, $view_mode, $form, &$form_state): The plugin settings form, as provided in hook_field_formatter_settings_form().
* settingsSummary($field, $instance, $view_mode): The plugin settings summary, as provided in Hook_field_formatter_setting_summary(). It shouls return an array, like in D8.
* viewElements($entity_type, $entity, $field, $instance, $langcode, $items, $display): The plugin render function, as provided in hook_field_formatter_view().

New plugins
===========
To create a new plugin you only have to create your own plugin class, extending from PluginFormatterBase and put it in the plugins folder. Formatter will be created autoatically once cache is cleared.
