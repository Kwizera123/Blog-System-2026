<?php

namespace App\Helpers;

class TutorialContentHelper
{
    public static function render($content)
    {
        return preg_replace_callback(
            '/\[code(?::([a-zA-Z0-9_-]+))?\](.*?)\[\/code\]/s',
            function ($matches) {

                $language = $matches[1] ?? 'code';

                $code = trim($matches[2]);

                return '
                    <div class="tutorial-code-block">
                        <div class="code-language">' .
                            e(strtoupper($language)) .
                        '</div>
                        <pre><code>' .
                            e($code) .
                        '</code></pre>
                    </div>
                ';
            },
            $content
        );
    }
}