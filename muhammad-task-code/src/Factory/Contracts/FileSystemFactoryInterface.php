<?php

namespace Tsc\CatStorageSystem\Factory\Contracts;

use \DateTimeInterface;

interface FileSystemFactoryInterface
{
  /**
   * @return string name
   * @return string directory
   * 
   * @return FileInterface
  */
  public function upload($name, $directory);

  /**
    * @param String Old path
    * @param String New path
    *
    * @return FileInterface
    */
  public function renameFile($directory, $newName);
     
   /**
    * @param String name
    *
    * @return bool
    */
  public function removeFile($name);
       

  /**
    * @param String name
    *
    * @return int
    */
  public function totalFile($directory);
    
  /**
    * @param String name
    *
    * @return array
    */
    public function allFiles($directory);
     
  /**
    * @param String name
    *
    * @return DirectoryInterface
    */
    public function makeRootDirectory($name);

  /**
    * @param String name
    * @param String parent name
    *
    * @return DirectoryInterface
    */
    public function makeDirectory($name, $parent);

/**
    * @param String name
    *
    * @return bool
    */
    public function removeDirectory($name);
       
/**
    * @param String Old Name
    * @param String New Name
    *
    * @return DirectoryInterface
    */
    public function renameDirectory($directory, $newName);
 
    /**
    * @param String name
    *
    * @return int
    */
    public function totalDirectories($directory);

    /**
    * @param String name
    *
    * @return int
    */
    public function sizeOfDirectory($directory);

    /**
    * @param String name
    *
    * @return array
    */
    public function allDirectory($directory);
      
}
