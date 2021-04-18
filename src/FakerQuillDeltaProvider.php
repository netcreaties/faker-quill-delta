<?php

namespace Netcreaties\FakerQuillDelta;

use Faker\Factory;
use Faker\Provider\Base;

class FakerQuillDeltaProvider extends Base
{
    public static $delta = [
        'ops' => []
    ];

    public static function buildQuillDelta($types = [])
    {
        foreach ($types as $type => $attributes) {
            switch ($type) {
                case 'heading':
                    self::addHeading(
                        isset($attributes['size']) ? $attributes['size'] : 1
                    );
                    break;
                case 'paragraph':
                    self::addParagraph($attributes);
                    break;
                default:
                    self::addBreak();
            }
        }

        return self::encodeAndReset();
    }

    public static function quillDeltaString($heading = true, $paragraphs = 3)
    {
        if ($heading) {
            self::addHeading();
        }

        for ($i = 0; $i < $paragraphs; $i++) {
            self::addParagraph();
        }

        return self::encodeAndReset();
    }

    private static function encodeAndReset()
    {
        $json = json_encode(self::$delta);

        self::$delta = [
            'ops' => []
        ];

        return $json;
    }

    private static function addHeading($size = 1)
    {
        $faker = Factory::create();

        self::$delta['ops'][] = [
            'insert' => $faker->sentence,
        ];
        self::$delta['ops'][] = [
            'insert' => PHP_EOL,
            'attributes' => [
                'header' => $size
            ]
        ];
    }

    private static function addParagraph($attributes = [])
    {
        $faker = Factory::create();

        self::$delta['ops'][] = [
            'insert' => $faker->paragraph,
            'attributes' => $attributes,
        ];
        self::addBreak();
    }

    private static function addBreak()
    {
        self::$delta['ops'][] = [
            'insert' => PHP_EOL
        ];
    }
}
