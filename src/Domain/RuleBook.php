<?php
declare(strict_types=1);


namespace BallGame\Domain;


use BallGame\Domain\Standings\TeamStanding;

class RuleBook
{
    public function __invoke(TeamStanding $teamStandingA, TeamStanding $teamStandingB)
    {
        if ($teamStandingA->getGamesWon() > $teamStandingB->getGamesWon()) {
            return -1;
        }

        if ($teamStandingB->getGamesWon() > $teamStandingA->getGamesWon()) {
            return 1;
        }

        return 0;
    }
}
