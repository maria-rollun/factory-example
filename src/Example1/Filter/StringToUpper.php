<?php

declare(strict_types=1);

namespace Example1\Filter;

class StringToUpper implements FilterInterface
{

    public function filter($value)
    {
        if (!is_scalar($value)) {
            return $value;
        }

        $value = (string)$value;

        return strtoupper($value);
    }
}
