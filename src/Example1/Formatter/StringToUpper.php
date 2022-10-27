<?php

declare(strict_types=1);

namespace Example1\Formatter;

class StringToUpper implements FormatterInterface
{

    public function format($value)
    {
        if (!is_scalar($value)) {
            return $value;
        }

        $value = (string)$value;

        return strtoupper($value);
    }
}
