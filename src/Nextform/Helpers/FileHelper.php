<?php

namespace Nextform\Helpers;

class FileHelper
{
    /**
     * @param array $data
     * @return boolean
     */
    public static function isUploadedFile($data) {
        $keys = ['name', 'type', 'tmp_name', 'error', 'size'];

        if (count($data) == count($keys)) {
            foreach ($keys as $k) {
                if ( ! array_key_exists($k, $data)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}