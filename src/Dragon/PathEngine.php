<?php

namespace Dragon;

class PathEngine
{
    const RIGHT = 1;
    const LEFT = -1;
    const length = 120;
    const nodes = 5;

    public $d;

    public function f($x, $y)
    {
        if ($y < 0) {
            return 0;
        }

        if ($y == 0){
            if ($x == 0) {
                return 1;
            }

            return 0;
        }

        $r = $this->d[$x][$y];
        if ($r != -1) {
            return $r;
        }

        $r = 0;
        $r = $r + $this->f(($x + 1) % self::nodes, $y - 1);
        $r = $r + $this->f(($x - 1 + self::nodes) % self::nodes, $y - 1);

        return $r;
    }

    public function run()
    {
        $this->initDMatrix();

        $this->f(0, self::length);

        //$totalPaths = gmp_fact(self::n);
        //$hasSamefinalOrientation = function($path) {
        //    return array_sum($path) % 5 == 0;
        //};
    }

    public function initDMatrix()
    {
        foreach(range(0,100) as $i) {
            $this->d[$i] = array_fill(1, 120, -1);
        }
    }
}

