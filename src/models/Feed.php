<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\models;

use \DanielZielkaRekrutacjaHRtec\helpers\PolishDateTime;

class Feed
{
    private $title;
    private $description;
    private $link;
    private $pubDate;
    private $creator;

    public function __get(string $param)
    {
        $method = 'get' . ucfirst($param);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new \InvalidArgumentException($param . ' does not exist in model Feed.');
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = preg_replace('/https?:\/\/[a-z\.0-9]+/i', '', strip_tags($description));
        
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        
        return $this;
    }

    public function getPubDate(): string
    {
        $date = new PolishDateTime($this->pubDate);

        return $date->format('d M Y H:i:s');
    }

    public function setPubDate(string $pubDate): self
    {
        $this->pubDate = $pubDate;
        
        return $this;
    }

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): self
    {
        $this->creator = $creator;
        
        return $this;
    }
}
