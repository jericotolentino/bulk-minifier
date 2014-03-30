<?php
/**
 * Bulk minifier
 *
 * A bulk JavaScript minifier script so such files can be
 * automatically minified during a build. Uses Google's Closure
 * Compiler.
 *
 * @author Jerico Tolentino <jhdtolentino@gmail.com>
 * @license WTFPL
 */

// Get current working directory
$cwd = getcwd();

// We need at least one file for this to run.
// Quit if we don't have it.
if (empty($argv[1])) {
    echo 'No file provided, quitting' . PHP_EOL;
}

// Loop through all possible project files and read
// their YAML configurations
for ($i = 1; $i < count($argv); $i++) {
    $file = $argv[$i] . '.yaml';
    if (file_exists($file)) {
        $data = yaml_parse_file($file);

        echo 'Starting compression for ' . $data['app'] . PHP_EOL . '=================================' . PHP_EOL;
        
        if (count($data['files']) > 0) {

            echo 'Compressing files:' . PHP_EOL;
            foreach ($data['files'] as $file) {
                exec('java -jar closure.jar --js ' . $data['path'] . $file['input'] . ' --js_output_file ' . $data['path'] . $file['output']);
                echo 'Compressed ' . $data['path'] . $file['input'] . ' to ' . filesize($data['path'] . $file['output']) . ' bytes' . PHP_EOL;
            }
            echo PHP_EOL;

        }

    // If a file is not found, just show a notification for it
    } else {
        echo $cwd . '/' . $file . ' not found, skipping.' . PHP_EOL;
    }
}
