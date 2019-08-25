<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\tests\CSVCreatorTest;

use LogicException;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use DanielZielkaRekrutacjaHRtec\models\Feed;
use DanielZielkaRekrutacjaHRtec\services\CSVCreator;


class CSVCreatorTest extends TestCase
{
    protected $feedData = [];
    protected $filePath = 'tests/exampleFile.csv';
    protected $schema = [
        'title' => 'title',
        'description' => 'description',
        'link' => 'link',
        'pubDate' => 'pubDate',
        'creator' => 'creator'
    ];

    public function setUp()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->feedData[] = (new Feed())
                ->setTitle('Example title')
                ->setDescription('Example description')
                ->setLink('https://www.bbc.co.uk/news/world-asia-49464427')
                ->setPubDate('2019-01-01 10:00:00')
                ->setCreator('Daniel Zielka');
        }
    }

    public function testSettersForSchema()
    {
        $creator = new CSVCreator();
        $creator->setSchema($this->schema);

        $creatorReflection = new ReflectionClass($creator);

        $propertySchema = $creatorReflection->getProperty('schema');
        $propertySchema->setAccessible(true);

        $this->assertEquals($propertySchema->getValue($creator), $this->schema);
    }

    public function testSettersForData()
    {
        $creator = new CSVCreator();
        $creator->setData($this->feedData);

        $creatorReflection = new ReflectionClass($creator);

        $propertyData = $creatorReflection->getProperty('data');
        $propertyData->setAccessible(true);

        $this->assertEquals($propertyData->getValue($creator), $this->feedData);
    }

    public function testSettersForFile()
    {
        $creator = new CSVCreator();
        $creator->setFile($this->filePath);

        $creatorReflection = new ReflectionClass($creator);

        $propertyFile = $creatorReflection->getProperty('file');
        $propertyFile->setAccessible(true);

        $this->assertEquals($propertyFile->getValue($creator), $this->filePath);
    }

    public function testExtendedSetterDoesFileExtist()
    {
        $creator = new CSVCreator();

        //Before we set the file property
        $this->expectException(LogicException::class);
        $creator->setExtended(true);
    }

    public function testExtendedCheckingFileExists()
    {
        $creator = new CSVCreator();
        $creator->setFile($this->filePath)->setExtended(true);

        $creatorReflection = new ReflectionClass($creator);

        $propertyExtended = $creatorReflection->getProperty('extended');
        $propertyExtended->setAccessible(true);

        //extended should be equal to bool returned by file_exists
        $this->assertEquals(file_exists($this->filePath), $propertyExtended->getValue($creator));
    }

    public function testCSVFileGenerationNoFileSetValidation()
    {
        $creator = (new CSVCreator())
            ->setSchema($this->schema)
            ->setData($this->feedData);

        $this->expectException(LogicException::class);
        $creator->generate();
    }

    public function testCSVFileGenerationNoSchemaSetValidation()
    {
        $creator = (new CSVCreator())
            ->setFile($this->filePath)
            ->setData($this->feedData);

        $this->expectException(LogicException::class);
        $creator->generate();
    }

    public function testCSVFileGenerationNoDataSetValidation()
    {
        $creator = (new CSVCreator())
            ->setFile($this->filePath)
            ->setSchema($this->schema);

        $this->expectException(LogicException::class);
        $creator->generate();
    }

    public function testCheckIfFileCreatedSuccessfuly()
    {
        $creator = (new CSVCreator())
            ->setFile($this->filePath)
            ->setSchema($this->schema)
            ->setData($this->feedData);

        $creator->generate();

        $this->assertTrue(file_exists($this->filePath));
        unlink($this->filePath);
    }
}
