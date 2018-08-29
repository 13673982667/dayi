
<?php
/**
 * Created by PhpStorm.
 * User: DreamBoy
 * Date: 2016/4/8
 * Time: 20:13
 */
header('content-type:text/html;charset=utf-8');
function delFile($fpath) {
    $filesize = array();
    $filepath = iconv('gb2312', 'utf-8', $fpath);
    if (is_dir($fpath)) {
        if ($dh = opendir($fpath)) {
            while (($file = readdir($dh)) !== false) {
                if($file != '.' && $file != '..') {
                    $filesize[] = delFile($fpath.'/'.$file);
                }
            }
            closedir($dh);
        }
        /*
        * 方便统计目录数
        */
        $filesize['file'] = 0;
        if(@rmdir($fpath) === true) {
            echo "{$filepath}................删除成功<br>\n";
        } else {
            echo "{$filepath}................删除失败<br>\n";
        }
    } else {
        if(is_file($fpath)) {
            $filesize[] = $fsize = filesize($fpath);
            if(@unlink($fpath) === true) {
                echo "{$filepath}...{$fsize}K................删除成功<br>\n";
            } else {
                echo "{$filepath}...{$fsize}K................删除失败<br>\n";
            }
        }
    }
        return $filesize;
}
/*
* function getArrSum(array &$arr) 数组求和
* array &$arr 被处理数组
*/
function getArrSum(&$arr) {
    if(is_array($arr)) {
    foreach ($arr as &$value) {
        $value = getArrSum($value);
    }
        return array_sum($arr);
    } else {
        return $arr;
    }
}

$fpath = 'D:/test';
$filesize = delFile($fpath);
$size = getArrSum($filesize);
printf('为您节省：%.3fM 空间', $size/(1024*1024));
?>
