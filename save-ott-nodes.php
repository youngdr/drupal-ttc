<?php

// clear all xml data
$result = db_truncate('field_data_field_xml')->execute();
drush_log("XML data truncate result: $result", 'ok');

$result = db_truncate('field_revision_field_xml')->execute();
drush_log("XML revision truncate result: $result", 'ok');

$result = db_query('SELECT entity_id as nid FROM field_data_field_send_to_ott where field_send_to_ott_value = 1');
$nids = $result->fetchCol(0);
$nodes = node_load_multiple($nids);
foreach ($nodes as $node) {
  drush_log("Saving node $node->nid", 'ok');
  _ttc_content_type_abstract_populate_xml($node);
  drush_log("Saved node $node->nid", 'ok');
}