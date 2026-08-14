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

            $prismLanguage = match (strtolower($language)) {
                'html' => 'markup',
                'blade' => 'markup',
                'css' => 'css',
                'javascript' => 'javascript',
                'php' => 'php',
                'laravel' => 'php',
                default => 'none',
            };

            $code = trim($matches[2]);

            return '
                    <div class="tutorial-code-block">

                        <div class="code-header">

                            <span class="code-language">' .
                                e(strtoupper($language)) .
                            '</span>

                            <button
                                type="button"
                                class="copy-code-btn"
                                onclick="copyCode(this)">
                                Copy
                            </button>

                        </div>

                        <pre><code class="language-' .
                            e($prismLanguage) .
                        '">' .
                            e($code) .
                        '</code></pre>

                    </div>
                ';
        },
        $content
    );
}
}