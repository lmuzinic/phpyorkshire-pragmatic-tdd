<?php
declare(strict_types=1);


namespace BallGame\Domain\Match;


use BallGame\Domain\Team\Team;

class Match
{
    /**
     * @var Team
     */
    private $homeTeam;

    /**
     * @var Team
     */
    private $awayTeam;

    /**
     * @var int
     */
    private $homeTeamPoints;

    /**
     * @var int
     */
    private $awayTeamPoints;

    /**
     * @param Team $homeTeam
     * @param Team $awayTeam
     * @param int $homeTeamPoints
     * @param int $awayTeamPoints
     */
    private function __construct(Team $homeTeam, Team $awayTeam, int $homeTeamPoints, int $awayTeamPoints)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->homeTeamPoints = $homeTeamPoints;
        $this->awayTeamPoints = $awayTeamPoints;
    }

    /**
     * @return Match
     */
    public static function create(Team $homeTeam, Team $awayTeam, $homeTeamPoints, $awayTeamPoints): Match
    {
        return new self($homeTeam, $awayTeam, $homeTeamPoints, $awayTeamPoints);
    }
}
