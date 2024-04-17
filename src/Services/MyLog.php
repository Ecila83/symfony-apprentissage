<?php
namespace App\Services;

use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem ;
use Symfony\Component\HttpKernel\Log\Logger;

class MyLog{
    public function __construct(private Filesystem $filesystem, private string $filename, private LoggerInterface $logger)
    {
        
    }
    public function writenLog(string $message){

        $this->logger->info('test');
        $this->filesystem->appendToFile($this->filename, $message .PHP_EOL);
    }
}