<?php
/**
 * Created by PhpStorm.
 * User: duXor
 * Date: 4/20/2017
 * Time: 21:54
 */

use PHPUnit\Framework\TestCase;

/**
 * Class DBConfigTest
 *
 * @author Dusan Perisic
 */
class DBConfigTest extends TestCase {
    /**
     * @author Dusan Perisic
     */
    public function testDBConfig()
    {
        $config = DBConfig::get();
        $config = json_decode($config);

        $this->assertNotNull($config->host);
        $this->assertNotNull($config->user);
        $this->assertNotNull($config->database);
    }
}
