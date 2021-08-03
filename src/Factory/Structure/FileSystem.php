<?php
namespace Tsc\CatStorageSystem\Factory\Structure;

use \DateTimeInterface;
use Tsc\CatStorageSystem\Factory\Contracts\FileInterface;
use Tsc\CatStorageSystem\Factory\Contracts\DirectoryInterface;
use Tsc\CatStorageSystem\Factory\Contracts\FileSystemInterface;

/**
 * 
 */
class FileSystem implements FileSystemInterface
{
	
	/**
	* @param FileInterface   $file
	* @param DirectoryInterface $parent
	*
	* @return FileInterface
	*/
	public function createFile(FileInterface $file, DirectoryInterface $parent) {
		
		$tempFile = $file->getName();
		$path = $parent->getPath().'/'.$this->basename($tempFile);

		if(! file_exists($tempFile))
			return null;

		if (!copy($tempFile, $path)) {
		    "failed to copy $file...\n";
		}

		$file->setName($this->basename($tempFile));
        $file->setSize(filesize($path));
		$file->setPath($path);

		return $file;
	}

	/**
	* @param FileInterface $file
	* @param string $newName
	*
	* @return FileInterface
	*/
	public function renameFile(FileInterface $file, $newName) {

		$oldPath = $file->getPath().'/'.$file->getName();

		if (! is_file($oldPath)) {
            return false;
        }

		$newPath = $file->getPath().'/'.$newName;
	
		rename($oldPath, $newPath);

		$file->setName($this->basename($newPath));
        $file->setSize(filesize($newPath));
		$file->setParentDirectory($this->dirname($newPath));
		$file->setPath($newPath);

		return $file;
	}
	

	/**
	* @param FileInterface $file
	*
	* @return bool
	*/
	public function deleteFile(FileInterface $file) {
		
		$path = $file->getPath().'/'.$file->getName();

		if (! is_file($path)) {
            return false;
        }

		return unlink($path);
	}
	

	/**
	* @param DirectoryInterface $directory
	*
	* @return int
	*/
	public function getFileCount(DirectoryInterface $directory) {
		
 		if (! is_dir($this->makeDirPath($directory))) {
            return [];
        }

		return count($this->glob($this->makeDirPath($directory) ."*" ));
		 
	}
	

	/**
	* @param DirectoryInterface $directory
	*
	* @return FileInterface[]
	*/
	public function getFiles(DirectoryInterface $directory) {
		
		if (! is_dir($this->makeDirPath($directory))) {
            return [];
        }

		return $this->glob($this->makeDirPath($directory).'/*.*');

	}

	/**
	* @param DirectoryInterface $directory
	*
	* @return string $path
	*/
	protected function makeDirPath(DirectoryInterface $directory) {
		return $directory->getPath().'/'.$directory->getName();

	}

    /**
     * Find path names matching a given pattern.
     *
     * @param  string  $pattern
     * @param  int  $flags
     * @return array
     */
    protected function glob($pattern, $flags = 0)
    {
        return glob($pattern, $flags);
    }

    /**
     * Extract the trailing name component from a file path.
     *
     * @param  string  $path
     * @return string
     */
    protected function basename($path)
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }

    /**
     * Extract the parent directory from a file path.
     *
     * @param  string  $path
     * @return string
     */
    protected function dirname($path)
    {
        return pathinfo($path, PATHINFO_DIRNAME);
    }

}