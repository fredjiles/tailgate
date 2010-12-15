<?php

namespace app\tests\cases\models;

use \app\models\Album;

class AlbumTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {}

    public function testFindFirst(){
        $record = Album::first();
        $result = count($record);
        $expected=1;
        $this->assertEqual($expected, $result);
    }
}

?>