<?php

namespace App\Helpers;

class TutorialContentHelper
{
    public static function render($content)
    {
        return preg_replace_callback(
            '/\[code\](.*?)\[\/code\]/s',
            function ($matches) {

                $code = trim($matches[1]);

                return '<pre><code>' . e($code) . '</code></pre>';
            },
            $content
        );
    }
}