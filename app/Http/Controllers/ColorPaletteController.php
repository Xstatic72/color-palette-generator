<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorPaletteController extends Controller
{
    public function index()
    {
        return view('color-palette');
    }


    private const PRIMARY_HUES = [
        'r'   => 0,   // 0° on the color wheel
        'g' => 120, // 120° on the color wheel
        'b'  => 240  // 240° on the color wheel
    ];

    public function generate(Request $request)
    {
        // Random color using HSL values
        // $baseHue = self::PRIMARY_HUES[array_rand(self::PRIMARY_HUES)];
        // $colors = [];

        // for($i = 0; $i < 5; $i++) {
        //     $hue = $baseHue;
        //     $saturation = rand(50, 100);
        //     $lightness = rand(30, 70);

        //     $colors[] = $this->hslToHex($hue, $saturation, $lightness);
        // }



        // Random color using RGB values
        $baseColor = array_rand(self::PRIMARY_HUES);
        $colors = [];

        for ($i = 0; $i < 5; $i++) {
            $secondary= rand(0, 120);

            $r= ($baseColor === 'r') ? 255 : $secondary;
            $g= ($baseColor === 'g') ? 255 : $secondary;
            $b= ($baseColor === 'b') ? 255 : $secondary;

            $colors[] = sprintf("#%02x%02x%02x", $r, $g, $b);
        }


        return view('color-palette', ['colors' => $colors]);
    }

    public function hslToHex(int $hue, int $saturation, int $lightness): string
    {
        $saturation /= 100;
        $lightness /= 100;

        $c = (1 - abs(2 * $lightness - 1)) * $saturation;
        $x = $c * (1 - abs(fmod($hue / 60, 2) - 1));
        $m = $lightness - ($c / 2);

        if ($hue < 60) {
            $r = $c; $g = $x; $b = 0;
        } elseif ($hue < 120) {
            $r = $x; $g = $c; $b = 0;
        } elseif ($hue < 180) {
            $r = 0; $g = $c; $b = $x;
        } elseif ($hue < 240) {
            $r = 0; $g = $x; $b = $c;
        } elseif ($hue < 300) {
            $r = $x; $g = 0; $b = $c;
        } else {
            $r = $c; $g = 0; $b = $x;
        }

        return sprintf("#%02x%02x%02x", 
            round(($r + $m) * 255), 
            round(($g + $m) * 255), 
            round(($b + $m) * 255)
        );
    }
}
