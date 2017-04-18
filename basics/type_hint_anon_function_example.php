<?php
function eventManager($action, $key, 
                      callable $callback = NULL, 
                      array $params = NULL)
{
    static $events;     // static $events retains its value
    if ($action == 'init') {
        $events[$key] = $callback;
        return true;
    } else {
        return $events[$key]($params);
    }
}

// initialize event manager
eventManager('init', 'add', function ($p) { return $p[0] + $p[1]; });
eventManager('init', 'sub', function ($p) { return $p[0] - $p[1]; });
eventManager('init', 'mul', function ($p) { return $p[0] * $p[1]; });
eventManager('init', 'div', function ($p) { return $p[0] / $p[1]; });

// trigger event
var_dump(eventManager('trigger', 'mul', NULL, [3, 4]));
