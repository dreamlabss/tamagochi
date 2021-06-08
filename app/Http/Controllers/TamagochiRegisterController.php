<?php

namespace App\Http\Controllers;

use App\Tamagochi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TamagochiRegisterController extends Controller
{
    /**
     * @var Tamagochi $tamagochi
     */
    protected $tamagochi;

    public function __construct(Tamagochi $tamagochiModel)
    {
        $this->tamagochi = $tamagochiModel;
    }

    public function register(Request $request)
    {
        $name = $request->get('tamagochi');

        if (empty($name)) {
            return [
                'success' => false,
                'authorized' => false
            ];
        }
        $token = Str::random(24);

        $tamagochi = clone $this->tamagochi;
        $tamagochi->name = $name;
        $tamagochi->api_token = $token;
        $tamagochi->save();
        $tamagochi = $tamagochi->fresh();

        return [
            'tamagochi' => $tamagochi,
            'authorized' => true,
            'token' => $token,
            'success' => true
        ];
    }

    public function getUser(Request $request) 
    {
        $tamagochi = $request->user();

        return [
            'tamagochi' => $tamagochi,
            'authorized' => true,
            'success' => true
        ];
    } 
}
