<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\tests\cases\jiles\images;

use \app\controllers\albums;

class ThumbnailTest extends \lithium\test\Unit {

	/**
	 * Tests that controllers can be instantiated with custom request objects.
	 *
	 * @return void
	 */
	public function testAssertPass() {
		
		$this->assertEqual('$result', '$result');
	}
    public function testAssertFail(){
        $this->assertEqual('$result', "$result");
    }
}

?>