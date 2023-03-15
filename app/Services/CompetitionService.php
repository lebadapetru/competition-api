<?php

namespace App\Services;

use App\Http\Controllers\CompetitionController;
use App\Models\Competition;
use App\Models\CompetitionPlayer;
use App\Models\Player;

class CompetitionService
{

    /**
     * @param array $validatedData
     * @return Competition
     */
    public function createCompetition(array $validatedData): Competition
    {
        //we could also implement a DAO for this
        //considering we only save it to db without additional business logic
        return Competition::create([
            Competition::COL_NAME         => $validatedData[CompetitionController::PARAM_NAME],
            Competition::COL_PLAYER_LIMIT => $validatedData[CompetitionController::PARAM_PLAYER_LIMIT],
        ]);
    }

    /**
     * @param array       $validatedData
     * @param Competition $competition
     * @return void
     */
    public function addPlayerToCompetition(
        array       $validatedData,
        Competition $competition
    ): void
    {
        $player = Player::where(Player::COL_NAME, $validatedData[CompetitionController::PARAM_NAME])->first();
        $competition->players()->attach($player);
        $competition->refresh();
    }

    /**
     * @param array       $validatedData
     * @param Competition $competition
     * @param Player      $player
     * @return void
     */
    public function incrementPlayerScoreInCompetition(
        array       $validatedData,
        Competition $competition,
        Player      $player
    ): void
    {
        CompetitionPlayer::where(CompetitionPlayer::COL_COMPETITION_ID, $competition->id)
                         ->where(CompetitionPlayer::COL_PLAYER_ID, $player->id)
                         ->increment(
                             CompetitionPlayer::COL_SCORE,
                             $validatedData[CompetitionController::PARAM_SCORE]
                         );
    }
}
