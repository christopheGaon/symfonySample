<watcher/><?php
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 19/04/2017
 * Time: 20:53
 */
$name = $request->get('name', 'World') ?>



Bye <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>