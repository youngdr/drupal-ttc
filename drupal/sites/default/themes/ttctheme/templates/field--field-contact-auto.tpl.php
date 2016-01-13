<?php
/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>

<?php
$node = $element['#object'];

if (isset($node->field_pdf_img['und'][0])) {
  $ic_value = field_view_value('node', $node, 'field_pdf_img', $node->field_pdf_img['und'][0]);

  if (isset($ic_value['#title'])) {
    $ic_name = $ic_value['#title'];
  }
}
?>

<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <?php if (!$label_hidden): ?>
      <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>&nbsp;</div>
    <?php endif; ?>
    <div class="field-items"<?php print $content_attributes; ?>>
        <?php foreach ($items as $delta => $item): ?>
          <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
              <?php
              if (isset($item['#options']['entity']->vocabulary_machine_name) &&
                  $item['#options']['entity']->vocabulary_machine_name == 'contacts') {
                $contact = $item['#options']['entity'];
                $contact_view = taxonomy_term_view($contact);
                
                if(isset($ic_value)) {
                  $contact_view['ic_value'] = array(
                    '#type' => 'markup',
                    '#weight' => 1,
                    '#markup' => "<div class='ic-name'>${ic_value['#title']}</div>",
                  );
                  
                  $contact_view['field_contact_phone']['#weight'] = 2;
                  $contact_view['field_contact_email']['#weight'] = 3;
                }
                
                print render($contact_view);
              } else {
                print render($item);
              }
              ?>
          </div>
        <?php endforeach; ?>
    </div>
</div>
