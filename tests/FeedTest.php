<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\tests\Feed;

use PHPUnit\Framework\TestCase;
use DanielZielkaRekrutacjaHRtec\models\Feed;
use InvalidArgumentException;


class FeedTest extends TestCase
{
    public function testMagicMethodGetThrowsExceptionIfGetterDoesntExist()
    {
        $model = new Feed();

        $this->expectException(InvalidArgumentException::class);
        $model->exampleOfNotExistingProperty;
    }

    public function testSettersAndGettersForDescription()
    {
        $model = new Feed();

        $model->setTitle('Example title');
        $this->assertEquals($model->title, 'Example title');

        $model->setTitle('Example title 123456789');
        $this->assertEquals($model->title, 'Example title 123456789');
    }

    public function testSettersAndGettersCorrectValuesForDescription()
    {
        $model = new Feed();

        $model->setDescription('Example description 123456789 <br /><b><a href="test"></a><br />');
        $this->assertEquals(trim($model->description), 'Example description 123456789');

        $model->setDescription('Example description https://www.22hrtec.pl');
        $this->assertEquals(trim($model->description), 'Example description');

        $model->setDescription('Example description http://www.hrtec.pl');
        $this->assertEquals(trim($model->description), 'Example description');
    }

    public function testSettersAndGettersCorrectValuesForLink()
    {
        $model = new Feed();

        $model->setLink('https://www.bbc.co.uk/news/world-asia-49464427');
        $this->assertEquals($model->link, 'https://www.bbc.co.uk/news/world-asia-49464427');

        $model->setLink('http://www.bbc.co.uk/sport/athletics/49462877');
        $this->assertEquals($model->link, 'http://www.bbc.co.uk/sport/athletics/49462877');
    }

    public function testSettersAndGettersCorrectValuesForPubDate()
    {
        $model = new Feed();

        $model->setPubDate('2019-01-01 08:10:10');
        $this->assertEquals($model->pubDate, '01 Styczeń 2019 08:10:10');

        $model->setPubDate('2018-10-16 15:31:33');
        $this->assertEquals($model->pubDate, '16 Październik 2018 15:31:33');

        $model->setPubDate('01-02-2019 15:31:33');
        $this->assertEquals($model->pubDate, '01 Luty 2019 15:31:33');
    }

    public function testSettersAndGettersCorrectValuesForCreator()
    {
        $model = new Feed();

        $model->setCreator('Example creator');
        $this->assertEquals($model->creator, 'Example creator');

        $model->setCreator('Example creator 123456789');
        $this->assertEquals($model->creator, 'Example creator 123456789');
    }
}
