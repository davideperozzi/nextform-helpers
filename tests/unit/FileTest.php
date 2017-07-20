<?php

namespace Nextform\Helpers\Tests;

use PHPUnit\Framework\TestCase;
use Nextform\Helpers\FileHelper;

class FileTest extends TestCase
{
    /**
     *
     */
    public function testValidUploadedFileCheck() {
        $this->assertTrue(FileHelper::isUploadedFile([
            'name' => 'test.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => '/private/...',
            'error' => 0,
            'size' => 1000
        ]));
    }

    /**
     *
     */
    public function testInvalidUploadedFileCheck() {
         $this->assertFalse(FileHelper::isUploadedFile([
            'name' => 'test.jpg',
            'type' => 'image/jpeg',
            // 'tmp_name' => '/private/...',
            'error' => 0,
            'size' => 1000
        ]));
    }
}