<?php

namespace Netcreaties\FakerQuillDelta\Test;

use PHPUnit_Framework_TestCase;
use Netcreaties\FakerQuillDelta\FakerQuillDeltaProvider;

class FakerQuillDeltaProviderTest extends PHPUnit_Framework_TestCase
{
    private array $delta;

    protected function setUp()
    {
        $this->delta = json_decode(FakerQuillDeltaProvider::quillDeltaString(), true);
    }

    public function testQuillDeltaStringHasHeading()
    {
        $heading = $this->delta['ops'][1]['attributes'];

        $this->assertSame(['header' => 1], $heading);
    }

    public function testQuillDeltaStringHasCorrectNumberOfInserts()
    {
        $this->assertSame(9, count($this->delta['ops']));
    }
}
