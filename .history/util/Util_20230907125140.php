<?php

namespace app\util;

class Util
{
    public static function split_text_into_part($max_tokens, $text)
    {
        return Tokenizer::split_text($max_tokens, $text);
    }
}
