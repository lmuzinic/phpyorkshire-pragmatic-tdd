<?php
declare(strict_types=1);


namespace BallGame\Tests;


use BallGame\Domain\Match\Match;
use BallGame\Domain\DetailedRuleBook;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class StandingsWithDetailedRulebookTest extends TestCase
{
    private $standings;

    public function setUp()
    {
        $this->standings = Standings::create('Year 2019', DetailedRuleBook::class);
    }

    public function testGetName()
    {
        // Given
        $yorkCity = Team::create('York city');
        $manchester = Team::create('Manchester United');

        $match = Match::create($yorkCity, $manchester, 3, 1);

        $this->standings->record($match);

        $match = Match::create($yorkCity, $manchester, 0, 5);

        $this->standings->record($match);

        // When
        $standings = $this->standings->getStandings();

        $this->assertTrue(true);

        // Then
        $this->assertEquals([
            ['Manchester United', 6, 3, 3],
            ['York city', 3, 6, 3],
        ],
            $standings
        );
    }
}
