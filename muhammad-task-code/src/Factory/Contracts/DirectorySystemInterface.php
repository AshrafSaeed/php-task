<?php

namespace Tsc\CatStorageSystem\Factory\Contracts;

interface DirectorySystemInterface
{
  
  /**
   * @param DirectoryInterface $directory
   *
   * @return DirectoryInterface
   */
  public function createRootDirectory(DirectoryInterface $directory);

  /**
   * @param DirectoryInterface $directory
   * @param string $parent
   *
   * @return DirectoryInterface
   */
  public function createDirectory( DirectoryInterface $directory, $parent);

  /**
   * @param DirectoryInterface $directory
   *
   * @return bool
   */
  public function deleteDirectory(DirectoryInterface $directory);

  /**
   * @param DirectoryInterface $directory
   * @param string $newName
   *
   * @return DirectoryInterface
   */
  public function renameDirectory(DirectoryInterface $directory, $newName);

  /**
   * @param DirectoryInterface $directory
   *
   * @return int
   */
  public function getDirectoryCount(DirectoryInterface $directory);

  
  /**
   * @param DirectoryInterface $directory
   *
   * @return int
   */
  public function getDirectorySize(DirectoryInterface $directory);

  /**
   * @param DirectoryInterface $directory
   *
   * @return DirectoryInterface[]
   */
  public function getDirectories(DirectoryInterface $directory);

}
