<?php

namespace Knayz\CurlyBraceChecker;

class Checker {

    /**
     * @throws \InvalidArgumentException
     */
    public function check(string $str): bool
    {
        $str = preg_replace('/\s+/', '', $str);

        if (preg_match('/[^()]/', $str)) {
            throw new \InvalidArgumentException('Only curly braces are required.');
        }

        if (strlen($str) % 2 === 1) return false;

        $stack = new \SplStack();

        $chars = str_split($str);

        foreach ($chars as $char) {
            if ($char === '(') {
                $stack->push(true);
            } else if ($char === ')') {
                if ($stack->count() === 0) {
                    return false;
                }
                $stack->pop();
            }
        }
        return true;
    }
}