<?php

namespace Bolt\Common;

class ExceptionHandlers
{
    /**
     * @return callable|null
     */
    public static function current()
    {
        $handler = set_exception_handler('var_dump');
        restore_exception_handler();

        return $handler;
    }

    /**
     * @return callable[]
     */
    public static function all()
    {
        $handlers = [];

        while (true) {
            $prev = set_exception_handler('var_dump');
            restore_exception_handler();
            if (!$prev) {
                break;
            }
            $handlers[] = $prev;
            restore_exception_handler();
        }

        $rev = array_reverse($handlers);

        foreach ($rev as $handler) {
            set_exception_handler($handler);
        }

        return $handlers;
    }
}
