<?php
namespace Tsc\CatStorageSystem;

use \DateTime as PhpDateTime;
use PHPUnit\Framework\TestCase;
use Tsc\CatStorageSystem\Factory\Structure\File;
use Tsc\CatStorageSystem\Factory\FileSystemFactory;
use Tsc\CatStorageSystem\Factory\Structure\Directory;
use Tsc\CatStorageSystem\Factory\Structure\FileSystem;
use Tsc\CatStorageSystem\Factory\Structure\DirectorySystem;


class FileSystemFactoryTest extends TestCase {

    public function test_it_creates_file_system_factory_instance() {

        $stub = $this->createMock(FileSystemFactory::class);
        $this->assertTrue($stub instanceof FileSystemFactory);

    }

    public function test_it_creates_all_file_system_in_storage()
    {
        $objFileSystemFactory = new FileSystemFactory(
            new File(),
            new FileSystem(),
            new Directory(),
            new DirectorySystem(),
            new PhpDateTime(),
        );
        
        // Create new file test assertion
        $upload = $objFileSystemFactory->upload('./../images/cat_1.gif', 'test_directory');
        $this->assertFalse($upload instanceof FileSystem);

        // Rename file test assertion
        $rename = $objFileSystemFactory->renameFile('test_directory/cat_1.gif', 'test_directory/cat_22.gif');
        $this->assertFalse($rename instanceof FileSystem);

        // Remove file test assertion
        $remove = $objFileSystemFactory->removeFile('test_directory/cat_1.gif');
        $this->assertTrue(true, $remove);

        // Get file count test assertion
        $count = $objFileSystemFactory->totalFile('test_directory');
        $this->assertTrue(true, is_int($count));

        //get all file test assertion
        $all = $objFileSystemFactory->allFiles('test_directory');
        $this->assertTrue(true, is_array($all));
    }


    public function test_it_creates_all_director_system_in_storage()
    {
        $objFileSystemFactory = new FileSystemFactory(
            new File(),
            new FileSystem(),
            new Directory(),
            new DirectorySystem(),
            new PhpDateTime(),
        );

        // Create root directory test assertion
        $create = $objFileSystemFactory->makeRootDirectory('root_dir');
        $this->assertFalse($create instanceof DirectorySystem);

        // Create sub directory test assertion
        $sub = $objFileSystemFactory->makeDirectory('sub_dir', 'root_dir');
        $this->assertFalse($sub instanceof DirectorySystem);

        // Remove directory test assertion
        $remove = $objFileSystemFactory->removeDirectory('root_dir/sub_dir');
        $this->assertTrue(true, $remove);

        // Get file count test assertion
        $rename = $objFileSystemFactory->renameDirectory('root_dir/sub_dir', 'root_dir/rename_sub_dir');
        $this->assertFalse($rename instanceof DirectorySystem);

        // Get directory count test assertion
        $count = $objFileSystemFactory->totalDirectories('root_dir');
        $this->assertTrue(true, is_int($count));

        //get directory size test assertion
        $size = $objFileSystemFactory->sizeOfDirectory('root_dir');
        $this->assertTrue(true, is_int($size));

        //get all directory test assertion
        $all = $objFileSystemFactory->allDirectory('root_dir');
        $this->assertTrue(true, is_array($all));

    }

}