<?php

class FileOperations
{
    private string $typeRead = "";
    private array|null $data = [];

    public function __construct($typeRead, $data)
    {
        $this->typeRead = $typeRead;
        $this->data = $data;
    }

    public function openFile($filePath)
    {
        $file = fopen($filePath, $this->typeRead);
        if (!$file) {
            throw new RuntimeException('Can\'t open file');
        }
        return $file;
    }

    public function putToFile($filePath, $data): bool
    {
        $file = $this->openFile($filePath);
        fputcsv($file, $data);
        return fclose($file);
    }

    public function getFileData($filePath): array
    {
        $tmpDataArray = [];
        $newData = [];
        $file = $this->openFile($filePath);

        while (($fileItems = fgetcsv($file, 1000, ",")) !== false) {
            $tmpDataArray[] = $fileItems;
        }
        fclose($file);

        foreach ($tmpDataArray as $item) {
            $newData[] = array_combine($this->data, $item);
        }

        return $newData;
    }

    public function existItem($needleItem, $name, $filePath) : array|bool
    {
        $result = false;
        foreach ($this->getFileData($filePath) as $item) {
            if ($needleItem == $item[$name]) {
                $result = $item;
                break;
            }
        }
        return $result;
    }

    public function renameFunc($filePath, $newFilePath): bool
    {
        return rename($newFilePath, $filePath);
    }

    public function deleteFileDataItem($filePath, $newFilePath, $needleItem, $name): bool
    {
        foreach ($this->getFileData($filePath) as $item){
            if($needleItem === $item[$name]){
                continue;
            }else{
                $this->putToFile($newFilePath, $item);
            }
        }
        return $this->renameFunc($filePath, $newFilePath);
    }
}



