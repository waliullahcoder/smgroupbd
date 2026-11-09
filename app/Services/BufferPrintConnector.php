<?php

namespace App\Services;

use Mike42\Escpos\PrintConnectors\PrintConnector;

class BufferPrintConnector implements PrintConnector
{
    private $buffer = '';

    public function write($data): void
    {
        $this->buffer .= $data;
    }

    public function read($length): string
    {
        // Optional: implement if you're using `read`, but not required for printing
        return '';
    }

    public function getData(): string
    {
        return $this->buffer;
    }

    public function finalize(): void
    {
        // No final cleanup needed
    }

    public function close(): void
    {
        // No stream to close
    }

    public function __destruct()
    {
        // Nothing to clean up
    }
}
