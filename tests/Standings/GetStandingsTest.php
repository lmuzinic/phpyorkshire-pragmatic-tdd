<?php
declare(strict_types=1);


namespace BallGame\Tests\Standings;


use BallGame\Domain\Match\Match;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class GetStandingsTest extends TestCase
{
    /**
     * @var Standings
     */
    private $standings;

    public function setUp()
    {
        $this->standings = Standings::create('Year 2018');
    }

    public function testGetStandingsReturnsSortedStandings()
    {
        // Given
        $this->standings->record(
            Match::create(
                Team::create('Team 1'),
                Team::create('Team 2'),
                1,
                0
            )
        );

        // When
        $standings = $this->standings->getStandings();

        // Then
        $this->assertEquals([
            ['Team 1', 1, 0, 3],
            ['Team 2', 0, 1, 0],
        ], $standings);
    }

    public function testGetStandingsReturnsSortedStandingsWhereTeam2IsWinner()
    {
        // Given
        $this->standings->record(
            Match::create(
                Team::create('Team 1'),
                Team::create('Team 2'),
                0,
                3
            )
        );

        // When
        $standings = $this->standings->getStandings();

        // Then
        $this->assertEquals([
            ['Team 2', 3, 0, 3],
            ['Team 1', 0, 3, 0],
        ], $standings);
    }
}
