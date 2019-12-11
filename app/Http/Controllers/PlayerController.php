<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;

class PlayerController extends Controller
{
    /**
     * Import player information to database.
     *
     */
    protected function import()
    {
        /**
         * Solution for SSL certificate verification failure. (OpenSSL error)
         */
        $stream_context_options = array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $premier_url    = "https://fantasy.premierleague.com/api/bootstrap-static/";
        $premier_data   = file_get_contents($premier_url, false, stream_context_create($stream_context_options));
        $players        = json_decode($premier_data);


        foreach($players->elements as $key => $value) { 
            $id             = $value->id;
            $first_name     = $value->first_name;
            $second_name    = $value->second_name;
            $form           = $value->form;
            $total_points   = $value->total_points;
            $influence      = $value->influence;
            $creativity     = $value->creativity;
            $threat         = $value->threat;
            $ict_index      = $value->ict_index;

            $player = Player::firstOrCreate(
                [
                    'id' => $id
                ], 
                [
                    'first_name'    => $first_name, 
                    'second_name'   => $second_name,
                    'form'          => $form, 
                    'total_points'  => $total_points,
                    'influence'     => $influence, 
                    'creativity'    => $creativity, 
                    'threat'        => $threat,
                    'ict_index'     => $ict_index
                ]
            );
        }

        return "Done.";
    }

    /**
     * Get all players fullnames and IDs.
     *
     */
    protected function getFullnames() {
        $players = Player::fullnames();

        return response()->json($players);
    }

    /**
     * Get player data.
     * 
     * @param int $player_id
     * 
     */
    protected function show($player_id) {
        $players = Player::find($player_id);

        return response()->json($players);
    }
}
