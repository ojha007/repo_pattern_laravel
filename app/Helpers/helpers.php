<?php

function getModels($path)
{
    $out = [];
    $results = scandir($path);
    foreach ($results as $result) {
        if ($result === '.' or $result === '..') continue;
        $filename = $path . '/' . $result;
        if (is_dir($filename)) {
            $out = array_merge($out, getModels($filename));
        } else {
            $out[] = strtolower(basename(substr($filename, 0, -4)));
        }
    }
    return $out;
}

