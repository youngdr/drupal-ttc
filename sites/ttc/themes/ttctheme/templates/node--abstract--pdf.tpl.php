<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>

<?php 
  $nodeurl = url('pdf/'. strtolower($field_enumber[0]['value']) . '.pdf', ['absolute' => true]);
?>
<html>
    <head>
        <style>
            @page {
                /* ensure you append the header/footer name with 'html_' */
                header: html_AbstractHeader; /* sets <htmlpageheader name="AbstractHeader"> as the header */
                footer: html_AbstractFooter; /* sets <htmlpagefooter name="AbstractFooter"> as the footer */

            }
        </style>
    </head>
    <body>

    <htmlpageheader name="AbstractHeader">  
        <?php
        $pdf_img_render = render($content['field_pdf_img']);
        print $pdf_img_render;
        ?>
    </htmlpageheader>

    <htmlpagefooter name="AbstractFooter">  
        <div class="abstract__pdf-footer">
            <div class="footer-url"><a href="<?php print $nodeurl; ?>"><?php print $nodeurl; ?></a></div>
            <div class='footer-title'>NCI Technology Transfer Center</div>
            
            <?php
            /*$block = module_invoke('menu', 'block_view', 'menu-footer-menu--secondary');
            $rendered = render($block['content']);
            $filtered = preg_replace("/<\/a>.*?<a/s", "</a> | <a",  strip_tags($rendered, "<a>"));
            print $filtered;*/
            ?>
        </div>
    </htmlpagefooter>

    <article id="node-<?php print $node->nid; ?>" class="abstract__pdf abstract <?php print $classes; ?>"<?php print $attributes; ?>>
        <?php print render($title_prefix); ?>
        <?php if (!$page): ?>
          <h2<?php print $title_attributes; ?>>
              <?php print $title; ?>
          </h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php
        $has_summary_block = !empty($content['field_meta_long_desc']) ||
            !empty($content['field_enumber']) ||
            !empty($content['field_product_type']) ||
            !empty($content['field_meta_keywords']) ||
            !empty($content['field_opp_co_dev']) ||
            !empty($content['field_contact_auto']);
        ?>

        <?php if ($has_summary_block): ?>
          <div class="abstract__summary">
              <?php
              print render($content['field_meta_long_desc']);
              print render($content['field_enumber']);
              print render($content['field_product_type']);
              print render($content['field_meta_keywords']);
              print render($content['field_opp_co_dev']);
              print render($content['field_contact_auto']);
              ?>
          </div>
        <?php endif; ?>

        <?php
        print render($content['field_opp_description_text']);
        print render($content['field_opp_commapp_text']);
        print render($content['field_opp_compadv_text']);
        print render($content['field_opp_invs_text']);
        print render($content['field_development_stage']);
        print render($content['field_opp_pubs_text']);
        print render($content['field_pat_status']);
        print render($content['field_opp_rel_enum']);
        print render($content['field_therapeutic_area']);
        ?>
    </article>
</body>
</html>