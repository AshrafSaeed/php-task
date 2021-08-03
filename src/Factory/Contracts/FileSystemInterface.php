<?php

namespace Tsc\CatStorageSystem\Factory\Contracts;

interface FileSystemInterface
{
  /**
   * @param FileInterface   $file
   * @param DirectoryInterface $parent
   *
   * @return FileInterface
   */
  public function createFile(FileInterface $file, DirectoryInterface $parent);

  /**
   * @param FileInterface $file
   * @param string $newName
   *
   * @return FileInterface
   */
  public function renameFile(FileInterface $file, $newName);

  /**
   * @param FileInterface $file
   *
   * @return bool
   */
  public function deleteFile(FileInterface $file);

  /**
   * @param DirectoryInterface $directory
   *
   * @return int
   */
  public function getFileCount(DirectoryInterface $directory);

  /**
   * @param DirectoryInterface $directory
   *
   * @return FileInterface[]
   */
  public function getFiles(DirectoryInterface $directory);

}
