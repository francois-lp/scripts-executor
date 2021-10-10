<?php

try {
    // get script option "outputFolderPath"
    define('OPTION_OUTPUT_PATH', 'outputFolderPath::');
    $options = getopt('', [constant('OPTION_OUTPUT_PATH')]);
    if (!$options || !$output_folder_path = $options[str_replace('::', '', constant('OPTION_OUTPUT_PATH'))]) {
        throw new Exception('Missing option "' . constant('OPTION_OUTPUT_PATH') . '"');
    }

    // file path
    $current_datetime = date('Ymd_His');
    $file_path = $output_folder_path . DIRECTORY_SEPARATOR . $current_datetime . '_generated_by_php_script.txt';

    // file writing
    $content = 'PHP script executed from PHP';
    $fp = fopen($file_path, 'w');
    fwrite($fp, $content);
    fclose($fp);

    echo 'Php script executed from PHP';
} catch (Exception $e) {
    echo 'Error : ',  $e->getMessage(), "\n";
}
