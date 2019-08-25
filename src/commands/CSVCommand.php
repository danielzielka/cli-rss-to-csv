<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\commands;

use DanielZielkaRekrutacjaHRtec\services\CSVCreator;
use Symfony\Component\Console\Output\OutputInterface;
use DanielZielkaRekrutacjaHRtec\services\FeedResolver;

class CSVCommand
{
    private $feedResolver;
    private $csvCreator;
    private $output;

    public function __construct(FeedResolver $feedResolver, CSVCreator $csvCreator)
    {
        $this->feedResolver = $feedResolver;
        $this->csvCreator = $csvCreator->setSchema([
            'title' => 'title',
            'description' => 'description',
            'link' => 'link',
            'pubDate' => 'pubDate',
            'creator' => 'creator',
        ]);
    }

    public function simple(?string $url, ?string $path, OutputInterface $output): void
    {
        if (is_null($url) || is_null($path)) {
            throw new \InvalidArgumentException('URL or PATH not given.');
        }

        try {
            $feeds = $this->feedResolver->getData($url);
            $this->csvCreator->setFile($path . '.csv')->setData($feeds)->generate($path);

            $output->writeln('Feeds sucessfully saved to ' . $path);
        } catch (\Throwable $e) {
            $output->writeln('An error occured while saving feeds.');
            $output->writeln($e->getMessage());
        }
    }

    public function extended(?string $url, ?string $path, OutputInterface $output): void
    {
        try {
            if (!$url || !$path) {
                throw new \InvalidArgumentException('URL or PATH not given.');
            }

            $feeds = $this->feedResolver->getData($url);
            $this->csvCreator
                ->setFile($path . '.csv')
                ->setData($feeds)
                ->setExtended(true)
                ->generate($path);

            $output->writeln('Feeds sucessfully saved to ' . $path);
        } catch (\Throwable $e) {
            $output->writeln('An error occured while saving feeds.');
            $output->writeln($e->getMessage());
        }
    }
}
