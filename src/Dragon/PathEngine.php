<?php

namespace Dragon;

class PathEngine
{
    const length = 25;
    const nodes = 5;

    public $d;

    public function run()
    {
        $this->initDMatrix($this->d);

        return $this->f(0, self::length);
    }

    public function initDMatrix()
    {
        foreach(range(0, 5) as $i) {
            $this->d[$i] = array_fill(1, self::length, -1);
        }
    }

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

        $r = $this->f(($x + 1) % self::nodes, $y - 1);
        $r = $r + $this->f(($x - 1 + self::nodes) % self::nodes, $y - 1);
        $this->d[$x][$y] = $r;

        return $r;
    }
}

