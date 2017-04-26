<?php
declare(strict_types=1);
require_once __DIR__.'/init.php';

$input = $request->get('name', 'World');

$response->setContent(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));
$response->send();
