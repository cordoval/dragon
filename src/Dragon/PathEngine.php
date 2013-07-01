<?php

namespace Dragon;

class PathEngine
{
    const RIGHT = 1;
    const LEFT = -1;

    public function run()
    {
        $totalPaths = gmp_fact(120);

        $hasSamefinalOrientation = function($path) {
            return array_sum($path) % 5 == 0;
        };

        return $totalPaths;
        //return sizeof($paths);
    }
}
