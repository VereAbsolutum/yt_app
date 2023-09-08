<?php

namespace app\util;

use Gioni06\Gpt3Tokenizer\Gpt3TokenizerConfig;
use Gioni06\Gpt3Tokenizer\Gpt3Tokenizer;

class Tokenizer
{
    public static function split_text($max_tokens, $text)
    {
        $config = new Gpt3TokenizerConfig();
        $tokenizer = new Gpt3Tokenizer($config);

        $encoded = $tokenizer->encode($text);
        $tokens = $encoded['text'];
        $num_tokens = count($tokens);

        $result = [];
        $current_part = "";
        $current_count = 0;
        foreach ($tokens as $token) {
            if ($current_count == $max_tokens) {
                array_push($result, $current_part);
                $current_part = "";
                $current_count = 0;
            }
            $current_part .= " " . $token;
            $current_count++;
        }
        if ($current_part != "") {
            array_push($result, $current_part);
        }
        return $result;
    }
}
