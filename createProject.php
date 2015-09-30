<?php


$projectName = "Blog";



// Make target dir

$targetDir = __DIR__."/../".$projectName.'/'.$projectName;
//if (file_exists($targetDir) ) {
//    echo "Target dir $targetDir already exists.\n";
//    exit(-1);
//}

$created = @mkdir($targetDir);

//if (!$created) {
//    echo "Failed to create target dir $targetDir.\n";
//    exit(-1);
//}

$targetDir = realpath($targetDir);

if (!$targetDir) {
    echo "Target dir does not exist.\n";
    exit(-1);
}


$srcPath = './';

$objects = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($srcPath),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach($objects as $name => $object) {
    
    //Git and idea hidden directories
    if (strpos($name, "/.") !== false) {
        continue;
    }
    
    if ($object->isDir()) {
        continue;
    }

    $targetPath = $targetDir."/".$name;

    if (strcmp("createProject.php", $object->getFilename()) == 0) {
        continue;
    }

    echo $targetPath."  ";
    
    echo $name."\n";
    
    $contents = @file_get_contents($name);
    
    $targetPath = str_replace('AppName', $projectName, $targetPath);
    
    $dirName = dirname($targetPath);
    echo "dirname is $dirName \n";
    @mkdir($dirName, 0777, true);
    
    $contents = str_replace('AppName', $projectName, $contents);    
    $contents = str_replace('appname', strtolower($projectName), $contents);
    
    $written = @file_put_contents($targetPath, $contents);
    
    if (!$written) {
        echo "Failed to write contents for $targetPath\n";
        exit(-1);
    }

    //exit(0);
}
