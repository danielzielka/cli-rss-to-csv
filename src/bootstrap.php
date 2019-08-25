<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec;

use DI;
use Silly\Application;

require __DIR__ . '/../vendor/autoload.php';

$container = new DI\Container();

$app = new Application();
$app->useContainer($container);
