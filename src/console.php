<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec;

use DanielZielkaRekrutacjaHRtec\commands\CSVCommand;

require __DIR__ . '/bootstrap.php';

$app->command('csv:simple [URL] [PATH]', [CSVCommand::class, 'simple'])
    ->descriptions('Generates a new file with data from given url.', [
        'URL' => 'URL to rss feed',
        'PATH' => 'Path to a new file',
    ]);

$app->command('csv:extended [URL] [PATH]', [CSVCommand::class, 'extended'])
    ->descriptions('Generates a new file or extends the file if exists with data from given url.', [
        'URL' => 'URL to rss feed',
        'PATH' => 'Path to a new file',
    ]);

$app->run();
