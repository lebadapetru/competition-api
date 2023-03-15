<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPlayerToCompetitionRequest;
use App\Http\Requests\CreateCompetitionRequest;
use App\Http\Requests\IncrementPlayerScoreInCompetitionRequest;
use App\Http\Resources\CompetitionResource;
use App\Models\Competition;
use App\Models\Player;
use App\Services\CompetitionService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompetitionController extends Controller
{
    const PARAM_NAME         = 'name';
    const PARAM_PLAYER_LIMIT = 'player_limit';
    const PARAM_SCORE        = 'score';

    public function __construct(
        private readonly CompetitionService $competitionService
    )
    {
    }

    /**
     * List all competitions
     */
    public function getCompetitions(): AnonymousResourceCollection
    {
        $competitions = Competition::paginate(10);

        return CompetitionResource::collection($competitions);
    }

    /**
     * Get one competition
     */
    public function getCompetition(Competition $competition): CompetitionResource
    {
        return new CompetitionResource($competition);
    }

    /**
     * Create a competition.
     */
    public function createCompetition(CreateCompetitionRequest $request): CompetitionResource
    {
        $validatedData = $request->validated();

        return new CompetitionResource(
            $this->competitionService->createCompetition($validatedData)
        );
    }

    /**
     * Add a player to competition.
     */
    public function addPlayerToCompetition(
        AddPlayerToCompetitionRequest $request,
        Competition                   $competition
    ): CompetitionResource
    {
        $validatedData = $request->validated();

        $this->competitionService->addPlayerToCompetition($validatedData, $competition);

        return new CompetitionResource($competition);
    }

    /**
     * Increment player's score in a competition.
     */
    public function incrementPlayerScoreInCompetition(
        IncrementPlayerScoreInCompetitionRequest $request,
        Competition                              $competition,
        Player                                   $player
    ): CompetitionResource
    {
        $validatedData = $request->validated();

        $this->competitionService->incrementPlayerScoreInCompetition(
            $validatedData,
            $competition,
            $player
        );

        return new CompetitionResource($competition);
    }
}
