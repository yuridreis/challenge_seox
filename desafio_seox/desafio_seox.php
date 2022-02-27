<?php 
/*  
Plugin Name: Desafio Seox
Version: 1.0.0
Author: Yuri dos Reis
Author URI: https://www.linkedin.com/in/yuridosreis/
*/

defined('ABSPATH') or die();

class DesafioSeox {

    function __construct() {
        add_action('init', [$this, 'custom_post_type']);
        flush_rewrite_rules();
    }

    function activate() {
        $this->custom_post_type();
        $this->create_main_page();
        $this->synchronize_posts();
    }

    function custom_post_type() {
        register_post_type('imoveis', ['public' => true, 'label' => 'Imoveis']);
    }

    function create_main_page() {
        $my_page = array(
            'post_title' => 'Mega Imóveis Disponíveis',
            'post_content' => '[desafio_imoveis_shortcode]',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
        );
        $post_id = wp_insert_post($my_page);
    }

    function shortcode_imoveis($atts = [], $content = null) {
        $imoveis = get_posts(array('post_type' => 'imoveis', 'numberposts' => -1));
        $args = array(
    		'post_type' => 'imoveis',
    		'posts_per_page' => -1
    	);
    	$the_query = new WP_Query($args);
        if ($the_query->have_posts() ) {
            echo '<ul style="margin:100px">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                echo '<li style="font-size:25px">' . get_the_title() . '</li>';
            }
            echo '</ul>';
        }
    }

    function get_imoveis_filtered() {
        $imoveis_url = wp_remote_get('http://localhost:8000/imoveis');
        $imoveis = wp_remote_retrieve_body( $imoveis_url );
        $imoveis = json_decode($imoveis);

        $oportunidades_url = wp_remote_get('http://localhost:8000/oportunidades');
        $oportunidades = wp_remote_retrieve_body( $oportunidades_url );
        $oportunidades = json_decode($oportunidades);

        foreach($imoveis->data as $key => $imovel) {
            foreach($oportunidades->data as $oportunidade) {
                if($imovel->id == $oportunidade->imoveis_id){
                   unset($imoveis->data[$key]);
                   break;
                }
            }
        }
        $imoveis->data = array_values($imoveis->data);
        return $imoveis->data;
    }

    function synchronize_posts() {
        $imoveis = $this->get_imoveis_filtered();
        $imoveis_postados = get_posts(array('post_type' => 'imoveis', 'numberposts' => -1));

        foreach($imoveis_postados as $imovel) {
            wp_delete_post($imovel->ID, true);
        }
        
        foreach($imoveis as $imovel) {
            $my_page = array(
                'post_title' => 'Imovel '. $imovel->id,
                'post_content' => $imovel->id,
                'post_status' => 'publish',
                'post_type' => 'imoveis',
                'post_author' => 1,
            );
            $post_id = wp_insert_post($my_page);
        }
    }

    function custom_cron_interval($schedules) { 
        $schedules['10_minutes'] = array(
            'interval' => 1,
            'display'  => esc_html__( 'Every 10 minutes' ), );
        return $schedules;
    }
}

if (class_exists('DesafioSeox')) {
    $desafio_seox = new DesafioSeox();
    add_shortcode("desafio_imoveis_shortcode", [$desafio_seox, "shortcode_imoveis"]);
    /* add_filter( 'cron_schedules', [$desafio_seox, 'custom_cron_interval']);	
    add_action( 'synchronize_posts_hook', [$desafio_seox, 'synchronize_posts'] );
    if ( ! wp_next_scheduled( 'synchronize_posts_hook' ) ) {
        wp_schedule_event( time(), '10_minutes', 'synchronize_posts_hook' );
    } */
}

register_activation_hook(__FILE__, [$desafio_seox, 'activate']);

register_deactivation_hook(__FILE__, [$desafio_seox, 'deactivate']);