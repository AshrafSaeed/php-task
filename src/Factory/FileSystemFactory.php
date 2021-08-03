<?php
namespace Tsc\CatStorageSystem\Factory;

use \DateTime;
use Tsc\CatStorageSystem\Factory\Structure\File;
use Tsc\CatStorageSystem\Factory\Structure\Directory;
use Tsc\CatStorageSystem\Factory\Structure\FileSystem;
use Tsc\CatStorageSystem\Factory\Structure\DirectorySystem;
use Tsc\CatStorageSystem\Factory\Contracts\FileSystemFactoryInterface;

/**
 * 
 */

class FileSystemFactory implements FileSystemFactoryInterface
{
    /**
     * @var File Object
     */
    protected $objFile;

    /**
     * @var Directory Object
     */
    protected $objDirectory;

    /**
     * @var FileSys Object
     */
    protected $objFileSys;
    
    /**
     * @var Storage Object
     */
    protected $storage;

    /**
     * @var Date Time Object
     */
    protected $currentData;


    /**
    * Class constructor.
    */
    public function __construct(File $file, FileSystem $filesys, Directory $directory, DirectorySystem $dirsys, DateTime $datetime){

        $this->objFile = $file;
        $this->objFileSys = $filesys;

        $this->objDirectory = $directory;
        $this->objDirSys = $dirsys;

        $this->currentData = $datetime;
        $this->storage = $_SERVER['DOCUMENT_ROOT'].'/storage';
    }    

    /**
    * @param String name
    *
    * @return DirectoryInterface
    */
    public function upload($name, $directory){

        $parentObject = $this->makeRootDirectory($directory);

        $this->objFile->setName($name);
        $this->objFile->setCreatedTime($this->currentData);
        $this->objFile->setParentDirectory($parentObject->getPath());

        return $this->objFileSys->createFile($this->objFile, $parentObject);
    }

    /**
    * @param String Old Name
    * @param String New Name
    *
    * @return FileInterface
    */
    public function renameFile($directory, $newName) {
        
        $this->objFile->setName($directory);
        $this->objFile->setModifiedTime($this->currentData);
        $this->objFile->setPath($this->storage);

        return $this->objFileSys->renameFile($this->objFile, $newName);
        
    }

    /**
    * @param String name
    *
    * @return bool
    */
    public function removeFile($name) {
        
        $this->objFile->setName($name);
        $this->objFile->setPath($this->storage);

        return $this->objFileSys->deleteFile($this->objFile);
        
    }

    /**
    * @param String name
    *
    * @return int
    */
    public function totalFile($directory) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objFileSys->getFileCount($this->objDirectory);
        
    }

    /**
    * @param String name
    *
    * @return array
    */
    public function allFiles($directory) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objFileSys->getFiles($this->objDirectory);   
    }

    /**
    * @param String name
    *
    * @return DirectoryInterface
    */
    public function makeRootDirectory($name){

        $this->objDirectory->setName($name);
        $this->objDirectory->setCreatedTime($this->currentData);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->createRootDirectory($this->objDirectory);
    }

    /**
    * @param String name
    * @param String parent name
    *
    * @return DirectoryInterface
    */
    public function makeDirectory($name, $parent) {

        $parentObject = $this->makeRootDirectory($parent);

        $this->objDirectory->setName($name);
        $this->objDirectory->setCreatedTime($this->currentData);
        $this->objDirectory->setPath($parentObject->getPath());

        return $this->objDirSys->createDirectory($this->objDirectory, $parent);
    }

    /**
    * @param String name
    *
    * @return bool
    */
    public function removeDirectory($name) {
        
        $this->objDirectory->setName($name);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->deleteDirectory($this->objDirectory);
        
    }

    /**
    * @param String Old Name
    * @param String New Name
    *
    * @return DirectoryInterface
    */
    public function renameDirectory($directory, $newName) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->renameDirectory($this->objDirectory, $newName);
        
    }

    /**
    * @param String name
    *
    * @return int
    */
    public function totalDirectories($directory) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->getDirectoryCount($this->objDirectory);
        
    }

    /**
    * @param String name
    *
    * @return int
    */
    public function sizeOfDirectory($directory) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->getDirectorySize($this->objDirectory);
        
    }

    /**
    * @param String name
    *
    * @return array
    */
    public function allDirectory($directory) {
        
        $this->objDirectory->setName($directory);
        $this->objDirectory->setPath($this->storage);

        return $this->objDirSys->getDirectories($this->objDirectory);   
    }

}