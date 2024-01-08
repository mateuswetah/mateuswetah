<?php

/** 
 * Theme Block Styles
 */

if ( function_exists('register_block_style') ) {
    /**
     * Adds block styles
     */
    function mateuswetah_block_styles() {

        $inline_style_for_text_shadow = '
            .is-style-mateuswetah-text-shadowed {
                --text-shadow--offset-x: -0.0275em;
                --text-shadow--offset-y: 0.0275em;
                --text-shadow--stroke: 0.025em;

                text-shadow:
                    var(--text-shadow--offset-x)
                    var(--text-shadow--offset-y)
                    0px
                    var(--wp--preset--color--lightest), 

                    calc( var(--text-shadow--offset-x) - var(--text-shadow--stroke) )
                    calc( var(--text-shadow--offset-y) + var(--text-shadow--stroke) )
                    0px
                    var(--wp--preset--color--color-lighter);

            }
            @supports ( text-shadow: 1px 1px 1px 1px black ) {
                .is-style-mateuswetah-text-shadowed {
                    text-shadow:
                        var(--text-shadow--offset-x)
                        var(--text-shadow--offset-y)
                        0px
                        0px
                        var(--wp--preset--color--lightest), 
                        
                        var(--text-shadow--offset-x) 
                        var(--text-shadow--offset-y)
                        var(--text-shadow--stroke)
                        0px
                        var(--wp--preset--color--color-lighter);
                }
            }
        ';

        register_block_style(
            'core/heading',
            array(
                'name'         => 'mateuswetah-text-shadowed',
                'label'        => __( 'Text Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_text_shadow
            )
        );

        register_block_style(
            'core/post-title',
            array(
                'name'         => 'mateuswetah-text-shadowed',
                'label'        => __( 'Text Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_text_shadow
            )
        );

        register_block_style(
            'core/query-title',
            array(
                'name'         => 'mateuswetah-text-shadowed',
                'label'        => __( 'Text Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_text_shadow
            )
        );

        register_block_style(
            'core/paragraph',
            array(
                'name'         => 'mateuswetah-text-shadowed',
                'label'        => __( 'Text Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_text_shadow
            )
        );

        $inline_style_for_links_as_tags = '
            .is-style-mateuswetah-links-as-tags a {
                background-color: var(--wp--preset--color--color-lightest);
                color: var(--wp--preset--color--color-darker);
                padding: 0.25em 0.75em;
                border-radius: 100em;
                font-size: 0.938em;
                background-size: 100% 0%;
                background-image: linear-gradient(180deg, transparent 0%, var(--wp--preset--color--color-dark) 0%);
                transition: color 0.2s ease-in-out, background-size 0.2s ease-in-out;
            }
            .is-style-mateuswetah-links-as-tags a:hover,
            .is-style-mateuswetah-links-as-tags a:focus {
                cursor: pointer;
                color: var(--wp--preset--color--color-lightest);
            }
        ';

        register_block_style(
            'core/paragraph',
            array(
                'name'         => 'mateuswetah-links-as-tags',
                'label'        => __( 'Links as tags', 'mateuswetah' ),
                'inline_style' => $inline_style_for_links_as_tags
            )
        );

        register_block_style(
            'core/post-terms',
            array(
                'name'         => 'mateuswetah-links-as-tags',
                'label'        => __( 'Links as tags', 'mateuswetah' ),
                'inline_style' => $inline_style_for_links_as_tags
            )
        );

        $inline_style_for_post_card = '
            @media screen and (min-width: 782px) {
                .is-style-mateuswetah-post-card .wp-block-post {
                    position: relative;
                }
                .is-style-mateuswetah-post-card .wp-block-post .wp-block-columns {
                    position: absolute;
                    top: 50%;
                    left: 0;
                    -webkit-transform: translateY(-50%);
                    transform: translateY(-50%);
                    z-index: 0;
                }
            }
        ';
        register_block_style(
            'core/post-template',
            array(
                'name'         => 'mateuswetah-post-card',
                'label'        => __( 'Post Card', 'mateuswetah' ),
                'inline_style' => $inline_style_for_post_card
            )
        );

        $inline_style_for_image_shadow = '
            .is-style-mateuswetah-image-shadowed img {
                box-shadow: var(--wp--preset--shadow--medium);
            }
        ';

        register_block_style(
            'core/post-featured-image',
            array(
                'name'         => 'mateuswetah-image-shadowed',
                'label'        => __( 'Image Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_image_shadow
            )
        );

        register_block_style(
            'core/image',
            array(
                'name'         => 'mateuswetah-image-shadowed',
                'label'        => __( 'Image Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_image_shadow
            )
        );

        register_block_style(
            'tainacan/item-gallery',
            array(
                'name'         => 'mateuswetah-image-shadowed',
                'label'        => __( 'Image Shadow', 'mateuswetah' ),
                'inline_style' => $inline_style_for_image_shadow
            )
        );
    }
    add_action( 'init', 'mateuswetah_block_styles' );
}
