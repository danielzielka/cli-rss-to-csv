<?php declare(strict_types=1);
namespace DanielZielkaRekrutacjaHRtec\services;

class CSVCreator
{
    const DELMITER = ';';

    private $schema;
    private $data;
    private $file;
    private $extended = false;


    public function setSchema(array $schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setExtended(bool $extended): self
    {
        if (!$this->file) {
            throw new \LogicException('You have to set the file first.');
        }

        if (!\file_exists($this->file)) {
            $this->extended = false; // File couldn't be extended if not exists
        } else {
            $this->extended = $extended;
        }

        return $this;
    }

    public function generate(): void
    {
        if (!$this->file) {
            throw new \LogicException('You have to set the file first.');
        }
        
        if (!$this->schema) {
            throw new \LogicException('You have to set the schema first.');
        }
        
        if (!$this->data) {
            throw new \LogicException('You have to provide data first.');
        }

        $content = $this->generateCSVData();
        file_put_contents($this->file, $content, $this->extended ? FILE_APPEND : 0);
    }

    private function generateCSVData(): string
    {
        $fileStructure = $this->generateFileStructure();
        $return = '';
        foreach ($fileStructure as $row) {
            $return .= implode(self::DELMITER, $row) . PHP_EOL;
        }

        return $return;
    }

    private function generateFileStructure(): array
    {
        $fileStructure = [];

        if (!$this->extended) {
            $fileStructure[] = $this->generateHeaders();
        }
        
        $fileStructure = array_merge($fileStructure, $this->generateContent());

        return $fileStructure;
    }

    private function generateHeaders(): array
    {
        return array_keys($this->schema);
    }

    private function generateContent(): array
    {
        $return = [];
        foreach ($this->data as $model) {
            $row = [];
            foreach (array_values($this->schema) as $key) {
                $row[] = $model->$key;
            }

            $return[] = $row;
        }

        return $return;
    }
}
