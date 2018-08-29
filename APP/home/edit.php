<?php

function edit($pic,$up_dir)
{

    if (!file_exists($up_dir)) {
        mkdir($up_dir, 0777);
    }
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $pic, $result)) {

        $type = $result[2];
        if (in_array($type, array('jpeg', 'png', 'gif', 'bmp', 'png'))) {
            $new_file = $up_dir . date('YmdHis') . '.' . $type;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $pic)))) {
                $img_path = str_replace('../../..', '', $new_file);
                $path = substr($img_path, 1);
                echo $newPath = 'http://www.63218860.com/APP/home' . $path;
            }
        }
    }
    return $newPath;
}
?>