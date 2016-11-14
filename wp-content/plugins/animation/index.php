<?php
/*
	Plugin Name: Animation
	Plugin URI: https://wordpress.org/plugins/animation/
	Description: It is a plugin that adds animation or improve some visual content.
	Version: 0.1
	Author: Vinet Mickael
	Author URI: http://mvinet.fr
	License: GPL2
*/
    class Animation
    {
        function __construct()
        {
            // C'est ce qui permet d'activé le référencement des scripts & des CSS
            add_action( 'wp_enqueue_scripts', array( $this, 'add_script_animation' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'add_style_animation' ) );
        }

        /*
            Permet d'ajouter le fichier JavaScript à WordPress
            Quand le plugin est activé.
        */
        function add_script_animation()
        {
            // Enregistre le script
            wp_register_script( 'angular', plugins_url( '/js/angular.js', __FILE__ ), array( 'jquery' ) );
            wp_register_script( 'roundProgress', plugins_url( '/js/roundProgress.min.js', __FILE__ ) , array( 'jquery', 'angular' ) );
            wp_register_script( 'function', plugins_url( '/js/function.js', __FILE__ ), array( 'jquery', 'angular' ) );
            // Permet d'ajouter le script à WordPress
            wp_enqueue_script( 'angular' );        
            wp_enqueue_script( 'roundProgress' );
            wp_enqueue_script( 'function');
        }

        /*
            Permet d'ajouter le fichier CSS à WordPress
            Quand le plugin est activé
        */
        function add_style_animation()
        {
            // Enregistre le style
            wp_register_style( 'Animation' , plugins_url( '/css/animation.css', __FILE__ ) );
            // Permet d'ajouter le script à WordPress 
            wp_enqueue_style( 'Animation' );
        }
    }

    new Animation();
?>
