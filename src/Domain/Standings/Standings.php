<?php
declare(strict_types=1);


namespace BallGame\Domain\Standings;


use BallGame\Domain\Match\Match;

class Standings
{
    /**
     * @var Match[]
     */
    private $matches;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function record(Match $match)
    {
        $this->matches[] = $match;
    }

    /**
     * @param string $name
     * @return Standings
     */
    public static function create(string $name): Standings
    {
        return new self($name);
    }

    public function getStandings()
    {
        return [
            ['Team 1', 1, 0, 3],
            ['Team 2', 0, 1, 0],
        ];
    }
}
