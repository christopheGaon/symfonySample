<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 19/04/2017
 * Time: 15:45
 */
use PHPUnit\Framework\TestCase;

/**
 * Class IndexTest
 */
class IndexTest extends TestCase {

    public function testHello() {
        $_GET['name'] = 'Fabien';

        ob_start();
        include 'index.php';
        $content = ob_get_clean();
        $content = str_replace('<watcher/>','',$content);
        $this->assertEquals('Hello Fabien', $content);
    }
}
