<?php
namespace App\Services;

use Symfony\Component\Filesystem\Filesystem ;

class MyLog{
    public function __construct(private Filesystem $filesystem, private string $filename, private $logger)
    {
        
    }
    public function writenLog(string $message){

        $this->logger->info('test');
        $this->filesystem->appendToFile($this->filename, $message .PHP_EOL);
    }
}