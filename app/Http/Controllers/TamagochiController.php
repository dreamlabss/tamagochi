<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TamagochiController extends Controller
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @param Cache $cacheService
     */
    public function __construct(Cache $cacheService)
    {
        $this->cache = $cacheService;
    }

    public function action(Request $request)
    {
        $actionType = $request->get('action', 0);

        $tamagochi = $request->user();

        $lastAction = Cache::get('t_' . $tamagochi->id . '_action');

        if ($actionType == 0) {
            return [
                'success' => false,
                'message' => 'invalid_type'
            ];
        }

        Cache::put('t_' . $tamagochi->id . '_action', $actionType);
        $gameLose = false;

        if ($actionType == 1) {
            $tamagochi->hunger -= 1;

            if ($tamagochi->hunger < 0) {
                $tamagochi->health -= 1;
            }
        } elseif ($actionType == 2) {
            $tamagochi->fatigue += 1;

            if ($lastAction == 2) {
                $tamagochi->health -= 1;
            }
        } elseif ($actionType == 3) {
            $tamagochi->fatigue = 0;
            $tamagochi->health += 1;
            $tamagochi->hunger += 1;
        }

        if ($tamagochi->fatigue > 10) {
            $tamagochi->fatigue = 10;
        } elseif ($tamagochi->fatigue < 0) {
            $tamagochi->fatigue = 0;
        }

        if ($tamagochi->hunger > 10) {
            $tamagochi->hunger = 10;
        } elseif ($tamagochi->hunger < 0) {
            $tamagochi->hunger = 0;
        }

        if ($tamagochi->health > 10) {
            $tamagochi->health = 10;
        } elseif ($tamagochi->health <= 0) {
            $tamagochi->health = 0;
            $gameLose = true;
        }

        if ($gameLose) {
            $tamagochi->health = 10;
            $tamagochi->fatigue = 0;
            $tamagochi->hunger = 0;
        }

        $tamagochi->save();

        return [
            'success' => true,
            'tamagochi' => $tamagochi,
            'lose' => $gameLose
        ];
    }
}
