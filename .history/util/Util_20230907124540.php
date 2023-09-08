<?php

namespace app\util;

class Util
{
    public static function nome_da_funcao($max_tokens, $text)
    {
        return Tokenizer::split_text($max_tokens, $text);
    }
}
