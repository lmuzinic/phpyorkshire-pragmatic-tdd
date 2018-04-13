<?php
declare(strict_types=1);

namespace BallGame\Domain\Standings;


use BallGame\Domain\Team\Team;

class TeamStanding
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @var int
     */
    private $gamesWon = 0;

    /**
     * @var int
     */
    private $gamesLost = 0;

    /**
     * @var int
     */
    private $pointsScored = 0;

    /**
     * @var int
     */
    private $pointsAgainst = 0;

    /**
     * @var int
     */
    private $points = 0;

    private function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function recordWin()
    {
        $this->gamesWon += 1;
        $this->points += 3;
    }

    public function recordLost()
    {
        $this->gamesLost += 1;
    }

    public function recordPointsScored(int $points)
    {
        $this->pointsScored += $points;
    }

    public function recordPointsAgainst(int $points)
    {
        $this->pointsAgainst += $points;
    }

    /**
     * @return int
     */
    public function getGamesWon(): int
    {
        return $this->gamesWon;
    }

    /**
     * @return int
     */
    public function getGamesLost(): int
    {
        return $this->gamesLost;
    }

    /**
     * @return int
     */
    public function getPointsScored(): int
    {
        return $this->pointsScored;
    }

    /**
     * @return int
     */
    public function getPointsAgainst(): int
    {
        return $this->pointsAgainst;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    public static function create(Team $team): TeamStanding
    {
        return new self($team);
    }
}
