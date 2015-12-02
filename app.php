<?php

/**
 * Bloge application
 * 
 * @package bloge/meta-out-pack
 */

use Bloge\Apps\AdvancedApp;
use Bloge\Content\Advanced;
use Bloge\Content\Raw as Content;
use Bloge\Renderers\Twig as Renderer;

function twig_render ($string, array $data) {
    $twig = new Twig_Environment(new Twig_Loader_String());
    
    return $twig->render($string, $data);
}

$content = __DIR__ . '/content';
$theme   = __DIR__ . '/theme';

$renderer = new Renderer($theme);
$content  = new Advanced(new Content($content));

$content->processor()
    ->add(Bloge\process('content', [new Parsedown, 'text']))
    ->add(function ($route, $data) {
        if ($route === 'blog') {
            $data['content'] = twig_render($data['content'], $data);
        }
        
        return $data;
    });

$content->dataMapper()
    ->mapAll([
        'view' => 'page.twig'
    ])
    ->map(spyc_load_file(__DIR__ . '/meta.yml'))
    ->map('blog', [
        'title' => 'Bloggin is awesome!',
        'posts' => $content->browse('blog')
    ]);

return new AdvancedApp($content, $renderer);