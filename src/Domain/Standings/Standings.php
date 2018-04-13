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
     * @var string
     */
    private $ruleBook;

    /**
     * @param string $name
     * @param string $ruleBook
     */
    private function __construct(string $name, string $ruleBook)
    {
        $this->name = $name;
        $this->ruleBook = $ruleBook;
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
     * @param string $ruleBook
     * @return Standings
     */
    public static function create(string $name, string $ruleBook): Standings
    {
        return new self($name, $ruleBook);
    }

    public function getStandings()
    {
        /**
         * @var $teamStandings TeamStanding[]
         */
        $teamStandings = [];

        foreach ($this->matches as $match) {
            if (!array_key_exists(spl_object_hash($match->getHomeTeam()), $teamStandings)) {
                $teamStandings[spl_object_hash($match->getHomeTeam())] = TeamStanding::create($match->getHomeTeam());
            }

            if (!array_key_exists(spl_object_hash($match->getAwayTeam()), $teamStandings)) {
                $teamStandings[spl_object_hash($match->getAwayTeam())] = TeamStanding::create($match->getAwayTeam());
            }

            // Home team won
            if ($match->getHomeTeamPoints() > $match->getAwayTeamPoints()) {
                $teamStandings[spl_object_hash($match->getHomeTeam())]->recordWin();
                $teamStandings[spl_object_hash($match->getAwayTeam())]->recordLost();
            }

            // Away team won
            if ($match->getAwayTeamPoints() > $match->getHomeTeamPoints()) {
                $teamStandings[spl_object_hash($match->getAwayTeam())]->recordWin();
                $teamStandings[spl_object_hash($match->getHomeTeam())]->recordLost();
            }

            $teamStandings[spl_object_hash($match->getHomeTeam())]->recordPointsScored($match->getHomeTeamPoints());
            $teamStandings[spl_object_hash($match->getHomeTeam())]->recordPointsAgainst($match->getAwayTeamPoints());

            $teamStandings[spl_object_hash($match->getAwayTeam())]->recordPointsScored($match->getAwayTeamPoints());
            $teamStandings[spl_object_hash($match->getAwayTeam())]->recordPointsAgainst($match->getHomeTeamPoints());
        }

        $rulebook = new $this->ruleBook;
        uasort($teamStandings, function (TeamStanding $teamStandingA, TeamStanding $teamStandingB) use ($rulebook) {
            return $rulebook($teamStandingA, $teamStandingB);
        });

        $finalStandings = [];
        foreach ($teamStandings as $teamStanding) {
            $finalStandings[] = [
                $teamStanding->getTeam()->getName(),
                $teamStanding->getPointsScored(),
                $teamStanding->getPointsAgainst(),
                $teamStanding->getPoints(),
            ];
        }

        return $finalStandings;
    }
}
