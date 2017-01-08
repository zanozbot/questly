<?php namespace App\Library {

    class Arkanite {
        public function parse($data) {
            
            $data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Checking for link
            if (preg_match('/{http[s]*:\/\/[^\s]+}\[.+\]/', $data, $match)) {
                $data = preg_replace('/{/', '<a href="', $data);
                $data = preg_replace('/}/', '" target="_blank">', $data);
                $data = preg_replace('/\[/', '', $data);
                $data = preg_replace('/\]/', '</a>', $data);
            }
            
            if (preg_match('/--&#62;&#13;&#10;.+&#13;&#10;&#60;--/', $data, $match)) {
                $data = preg_replace('/--&#62;/', '<code>', $data);
                $data = preg_replace('/&#60;--/', '</code>', $data);
            }
            
            return $data;
        }
    }

}