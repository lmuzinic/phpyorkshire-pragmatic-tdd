<?php
declare(strict_types=1);


namespace BallGame\Tests;


use BallGame\Domain\Match\Match;
use BallGame\Domain\RuleBook;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class StandingsTest extends TestCase
{
    private $standings;

    public function setUp()
    {
        $this->standings = Standings::create('Year 2019', RuleBook::class);
    }

    public function testGetStandings()
    {
        // Given
        $yorkCity = Team::create('York city');
        $manchester = Team::create('Manchester United');

        $match = Match::create($yorkCity, $manchester, 3, 1);

        $this->standings->record($match);

        // When
        $standings = $this->standings->getStandings();

        // Then
        $this->assertEquals([
                ['York city', 3, 1, 3],
                ['Manchester United', 1, 3, 0]
            ],
            $standings
        );
    }
}
