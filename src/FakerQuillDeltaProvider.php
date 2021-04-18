<?php

namespace Netcreaties\FakerQuillDelta;

use Faker\Factory;
use Faker\Provider\Base;

class FakerQuillDeltaProvider extends Base
{
    public static array $delta = [
        'ops' => []
    ];

    public static function quillDeltaString($heading = true, $paragraphs = 3)
    {
        if ($heading) {
            self::addHeading();
        }

        for ($i = 0; $i < $paragraphs; $i++) {
            self::addParagraph();
        }

        $json = json_encode(self::$delta);

        self::$delta = [
            'ops' => []
        ];

        return $json;
    }

    private static function addHeading(int $size = 1)
    {
        $faker = Factory::create();

        self::$delta['ops'][] = [
            'insert' => $faker->sentence,
        ];
        self::$delta['ops'][] = [
            'insert' => '\n',
            'attributes' => [
                'header' => $size
            ]
        ];
        self::addBreak();
    }

    private static function addParagraph()
    {
        $faker = Factory::create();

        self::$delta['ops'][] = [
            'insert' => $faker->paragraph
        ];
        self::addBreak();
    }

    private static function addBreak()
    {
        self::$delta['ops'][] = [
            'insert' => '\n'
        ];
    }
}
