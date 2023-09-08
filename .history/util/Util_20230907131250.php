<?php

namespace app\util;

use app\Tokenizer\Tokenizer;

class Util
{
    public static function split_text_into_part($max_tokens, $text)
    {
        return Tokenizer::split_text($max_tokens, $text);
    }
}
