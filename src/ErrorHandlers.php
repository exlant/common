<?php

namespace Bolt\Common;

class ErrorHandlers
{
    /**
     * @return callable|null
     */
    public static function current()
    {
        $handler = set_error_handler('var_dump');
        restore_error_handler();

        return $handler;
    }

    /**
     * @return callable[]
     */
    public static function all()
    {
        $handlers = [];

        while (true) {
            $prev = set_error_handler('var_dump');
            restore_error_handler();
            if (!$prev) {
                break;
            }
            $handlers[] = $prev;
            restore_error_handler();
        }

        $rev = array_reverse($handlers);

        foreach ($rev as $handler) {
            set_error_handler($handler);
        }

        return $handlers;
    }
}
