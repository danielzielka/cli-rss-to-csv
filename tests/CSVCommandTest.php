<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\tests\CSVCommandTest;

use PHPUnit\Framework\TestCase;
use DanielZielkaRekrutacjaHRtec\commands\CSVCommand;
use DanielZielkaRekrutacjaHRtec\services\FeedResolver;
use DanielZielkaRekrutacjaHRtec\services\CSVCreator;
use Symfony\Component\Console\Output\ConsoleOutput;
use InvalidArgumentException;


class CSVCommandTest extends TestCase
{
    public function testSimpleCommandArguments()
    {
        $command = new CSVCommand(new FeedResolver(), new CSVCreator());

        $this->expectException(InvalidArgumentException::class);
        $command->simple('http://feeds.bbci.co.uk/news/world/rss.xml', null, new ConsoleOutput());

        $this->expectException(InvalidArgumentException::class);
        $command->simple(null, 'tests/file', new ConsoleOutput());

        $this->expectException(InvalidArgumentException::class);
        $command->simple(null, null, new ConsoleOutput());
    }
}
