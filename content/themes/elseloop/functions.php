<?php

/**
 * Remove inline height & width values from images in content
 */
add_filter( 'the_content', 'elseloop_remove_img_dimensions', 10 );

function elseloop_remove_img_dimensions( $html ) {
   
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

   return $html;
   
}

/**
 * Replace #wp_caption divs with HTML5 figures
 * and remove inline styles/random extra 10px
 */
add_filter('img_caption_shortcode', 'elseloop_img_caption_shortcode_filter',10,3);

function elseloop_img_caption_shortcode_filter($val, $attr, $content = null)
{
  extract(shortcode_atts(array(
    'class'  => 'blowout',
    'align' => 'aligncenter',
    'caption' => ''
  ), $attr));

  $fig_classes = '';
  if ( $class ) {
    $class        = esc_attr($class);
    $fig_classes  = "class='figcaption-" . $class . "'";
    $class        = "class='$class' aria-labelledby='figcaption-$class'";
  }

  $figure = "";
  $figure .= "<figure $class>";
  $figure .= do_shortcode( $content );
  $figure .= "<figcaption $fig_classes>";
  $figure .= "<p>$caption</p>";
  $figure .= "</figcaption>";
  $figure .= "</figure>";
  
  return  $figure;

}

/**
 * replace default p tags wrapping images in content with div.blowout
 */
add_filter( 'the_content', 'elseloop_img_blowout', 12 );

function elseloop_img_blowout($html) {

  $html = preg_replace('/<p[^>]*>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\/p>/', '<div class="blowout">$1</div>', $html);

  return $html;

}