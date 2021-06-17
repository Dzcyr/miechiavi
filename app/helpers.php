<?php

/**
 * OSS 路径添加年月日目录
 *
 * @Author 佟飞
 * @DateTime 2021-06-17
 * @param [type] $path
 * @return void
 */
function oss_path_processing($path)
{
    return $path . '/' . date('Y') . '/' . date('m') . '/' . date('d');
}
