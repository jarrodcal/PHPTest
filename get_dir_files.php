<?php

    function getAllDirFiles($dir)
    {
        $allFiles = array();

        if (is_dir($dir))
        {
            if ($handle = @opendir($dir))
            {
                while (($file = readdir($handle)) != false)
                {
                    if ($file == '.' || $file == "..")
                        continue;

                    if (is_dir($file))
                        $allFiles["{$dir}/{$file}"] = getAllDirFiles("{$dir}/{$file}");

                    $allFiles[$dir][] = $file;
                }

                closedir($handle);
            }
        }

        return $allFiles;
    }

    $dir = "/usr/home/qingfang";
    $files = getAllDirFiles($dir);
    print_r($files);
