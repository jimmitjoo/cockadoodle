<?php
namespace CAD;

class ImageHandler {

    /**
     * @param $image
     * @return string
     */
    public function save_base64_image($image)
    {
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        return $data;
    }

}