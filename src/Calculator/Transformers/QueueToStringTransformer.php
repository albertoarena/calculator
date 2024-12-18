<?php

namespace Calculator\Transformers;

use Calculator\Numbers\Result;
use Calculator\Stacks\Stack;

class QueueToStringTransformer
{
    protected const COMPACT_SPACE_MARKER = '$$$';

    protected const NORMALISATIONS = [
        // Normalise spaces
        ' '.self::COMPACT_SPACE_MARKER.' ' => '',

        // Normalise double parentheses
        '((' => '(',
        '))' => ')',

        // Normalise Fibonacci number and percentage
        ' ! ' => '! ',
        ' % ' => '% ',
    ];

    protected static function normalise(array $queue): string
    {
        $ret = implode(' ', $queue);

        return str_replace(
            array_keys(self::NORMALISATIONS),
            array_values(self::NORMALISATIONS),
            $ret
        );
    }

    public static function transform(Stack $queueOriginal, bool $resultInString): string
    {
        // Normalise operators with inverted string order
        $queue = [];
        while ($queueOriginal->count()) {
            $item = $queueOriginal->shift();
            $queue[] = $item;
            $index = count($queue) - 1;
            if ($item->getStringOrder() < 0 && $index > 0) {
                // swap with previous item
                $v = $queue[$index - 1];
                $queue[$index - 1] = $item;

                if ($item->getStringBrackets()) {
                    $queue[$index] = "($v)";
                } else {
                    $queue[$index] = $v;
                }
                $queue = array_merge(
                    array_slice($queue, 0, $index),
                    [self::COMPACT_SPACE_MARKER],
                    array_slice($queue, $index)
                );
            }
        }

        if (! $resultInString) {
            $queue = array_filter($queue, function ($item) {
                return ! $item instanceof Result;
            });
        }

        $queueOriginal->reset();

        return self::normalise($queue);
    }
}
