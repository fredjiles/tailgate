<?php

namespace app\tests\cases\models;

use \app\models\Monkey;

class MonkeyTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {}


    public function testFindOne(){
        $record = Monkey::first();
        $result = count($record);
        $expected=1;
        $this->assertEqual($expected, $result);
    }

    public function testFindAll(){
        $record = Monkey::all();
        $result = count($record);
        $expected=2;
        $this->assertEqual($expected, $result);
    }

}

?>