<?php

namespace Dragon;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * A dragon flies in a series of one-fifth circular arcs (72).
 * and with a free choice of a clockwise or an anticlockwise arch
 * for each step.
 *
 * - any arch may be traversed multiple times
 * - in each step, the direction change must be exactly +/- 72
 * - both the starting and the end direction must be north
 * - all arcs must have the same radius
 */
class PathEngineCommand extends Command
{
    const length = 5;
    const nodes = 5;

    public $d;

    protected function configure()
    {
        $this
            ->setName('path_engine_command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initDMatrix($this->d);

        $output->writeln($this->f(0, self::length, $output));
    }

    public function initDMatrix()
    {
        foreach(range(0, self::nodes - 1) as $i) {
            $this->d[$i] = array_fill(0, self::length + 1, -1);
        }
    }

    public function f($x, $y, OutputInterface $output)
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

        if ($this->d[$x][$y] != -1) {
            return $this->d[$x][$y];
        }

        $this->d[$x][$y] = 0;
        $this->d[$x][$y] = $this->f(($x + 1) % self::nodes, $y - 1, $output) + $this->f(($x - 1 + self::nodes) % self::nodes, $y - 1, $output);

        $table = $this->getApplication()->getHelperSet()->get('table');
        $table->setRows($this->d);
        $table->render($output);

        return $this->d[$x][$y];
    }
}

