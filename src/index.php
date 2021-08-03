<?php
require __DIR__.'./../vendor/autoload.php';

use \DateTime as PhpDateTime;
use Tsc\CatStorageSystem\Factory\Structure\File;
use Tsc\CatStorageSystem\Factory\FileSystemFactory;
use Tsc\CatStorageSystem\Factory\Structure\Directory;
use Tsc\CatStorageSystem\Factory\Structure\FileSystem;
use Tsc\CatStorageSystem\Factory\Structure\DirectorySystem;

$obj = new FileSystemFactory(
	new File(),
	new FileSystem(),
	new Directory(),
	new DirectorySystem(),
	new PhpDateTime(),
);

echo '<pre>';

$data = $obj->upload('./../images/cat_1.gif', 'ashraf');
var_dump($data);

$data = $obj->renameFile('ashraf/cat_1.gif', 'ashraf/cat_22.gif');
var_dump($data);

$data = $obj->removeFile('ashraf/cat_1.gif');
var_dump($data);

$data = $obj->totalFile('ashraf');
var_dump($data);

$data = $obj->allFiles('ashraf');
var_dump($data);

echo '<br><br>------------------------------------------------<br><br><br>';

$data = $obj->makeRootDirectory('ali');
var_dump($data);

$data = $obj->makeDirectory('mydir3', 'neimages');
var_dump($data);

$data = $obj->removeDirectory('neimages/mydir3');
var_dump($data);

$data = $obj->renameDirectory('neimages/mydir2', 'neimages/rename_dir');
var_dump($data);

$data = $obj->totalDirectories('neimages');
var_dump($data);

$data = $obj->sizeOfDirectory('neimages');
var_dump($data);

$data = $obj->allDirectory('neimages');
var_dump($data);


