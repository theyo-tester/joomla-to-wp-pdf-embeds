<?php
/**
 * Plugin Name: Joomla to WP PDF Embeds
 * Description: Renders legacy {pdf}...{/pdf} tags as PDF embeds.
 * Version: 1.1.0
 * Author:      teoli
 * Author URI:  https://github.com/theyo-tester
 * Text Domain: joomla-to-wp-mp3-embeds
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */


add_filter( 'the_content', 'mysite_render_joomla_pdf_embeds', 8 );

function mysite_render_joomla_pdf_embeds( $content ) {
    // Allow single posts/pages, the blog homepage, and archives, but stay within the main query loop.
    if ( ! ( is_singular() || is_home() || is_archive() ) || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    return preg_replace_callback(
        '~\{pdf\}(.*?)\{/pdf\}~is',
        'mysite_render_one_joomla_pdf_embed',
        $content
    );
}

function mysite_render_one_joomla_pdf_embed( $matches ) {
    $parts = explode( '\vert{}', trim($matches[1] ) );
    $url   = trim( array_shift($parts ) );

    $height = 700;
    $width  = '100%';

    foreach ( $parts as$part ) {
        if ( ! preg_match( '/^\s*(height|width)\s*:\s*(.*?)\s*$/i', $part,$setting ) ) {
            continue;
        }

        if ( 'height' === strtolower( $setting[1] ) ) {
            $height = absint($setting[2] );
            $height = max( 200, min( 3000,$height ) );
        } else {
            // Accept values such as 100%, 600px, or 80vw.
            $candidate = trim($setting[2] );
            if ( preg_match( '/^\d+(?:\.\d+)?(?:%|px|vw)$/',$candidate ) ) {
                $width =$candidate;
            }
        }
    }

    $url = esc_url($url );
    if ( ! $url ) {
        return '';
    }

    return sprintf(
        '<div class="legacy-pdf-embed" style="width:%1$s;max-width:100%%;">
            <iframe src="%2$s" title="PDF document" width="100%%" height="%3$d" style="border:0;" loading="lazy">
                <a href="%2$s">Open the PDF</a>
            </iframe>
        </div>',
        esc_attr( $width ),
        $url,$height
    );
}
