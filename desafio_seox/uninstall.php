<?php 

defined('WP_UNINSTALL_PLUGIN') or die();

$imoveis = get_posts(array('post_type' => 'imoveis', 'numberposts' => -1));

foreach($imoveis as $imovel) {
    wp_delete_post($imovel->ID, true);
}