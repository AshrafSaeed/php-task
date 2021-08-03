<?php
namespace Tsc\CatStorageSystem\Factory\Structure;

use \DateTimeInterface;
use Tsc\CatStorageSystem\Factory\Contracts\FileInterface;
use Tsc\CatStorageSystem\Factory\Contracts\DirectoryInterface;
use Tsc\CatStorageSystem\Factory\Contracts\DirectorySystemInterface;

/**
 * 
 */
class DirectorySystem implements DirectorySystemInterface
{

	/**
	* @param DirectoryInterface $directory
	*
	* @return DirectoryInterface
	*/
	public function createRootDirectory(DirectoryInterface $directory) {
		
		$name = $directory->getName();
        $path = $directory->getPath();

        @mkdir($path.'/'.$name, 0755, true);
        $directory->setPath($path.'/'.$name);

	    return $directory;
	}

	/**
	* @param DirectoryInterface $directory
	* @param string $parent
	*
	* @return DirectoryInterface
	*/
	public function createDirectory( DirectoryInterface $directory, $parent) {

		$name = $directory->getName();
        $path = $directory->getPath();
        
        @mkdir($path.'/'.$name, 0755, true);
        $directory->setName($parent.'/'.$name);
        $directory->setPath($path.'/'.$name);

        return $directory;
	}
	

	/**
	* @param DirectoryInterface $directory
	*
	* @return bool
	*/
	public function deleteDirectory(DirectoryInterface $directory) {
	
		$path = $directory->getPath().'/'.$directory->getName();
		if (! is_dir($path)) {
            return false;
        }

        $items = new \FilesystemIterator($path);

        foreach ($items as $item) {

            if ($item->isDir() && ! $item->isLink()) {
                $this->deleteDirectory($item->getPathname());
            } else {
                unlink($item->getPathname());
            }
        }

        @rmdir($path);

        return true;

	}

	
	/**
	* @param DirectoryInterface $directory
	* @param string $newName
	*
	* @return DirectoryInterface
	*/
	public function renameDirectory(DirectoryInterface $directory, $newName) {
	
		$oldPath = $directory->getPath().'/'.$directory->getName();

		if (! is_dir($oldPath)) {
            return false;
        }

		$newPath = $directory->getPath().'/'.$newName;
	
		rename($oldPath, $newPath);

		$directory->setName($newName);

		return $directory;
	}
	

	/**
	* @param DirectoryInterface $directory
	*
	* @return int
	*/
	public function getDirectoryCount(DirectoryInterface $directory) {
		
		$path = $directory->getPath().'/'.$directory->getName();

		if (! is_dir($path)) {
            return 0;
        }

		return count( glob($path.'/*', GLOB_ONLYDIR) );
	
	}

	/**
	* @param DirectoryInterface $directory
	*
	* @return int
	*/
	public function getDirectorySize(DirectoryInterface $directory) {
		
		$path = $directory->getPath().'/'.$directory->getName();
	    if (! is_dir($path)) {
            return 0;
        }

	    return $this->calculateDirSize($path);

	}
	
	/**
	* @param String $path
	*
	* @return int
	*/
	protected function calculateDirSize($path) {
		
		$dirsize = 0;
	    $directory = glob($path.'/*');
	    foreach($directory as $file){
	        is_file($file) && $dirsize += filesize($file);
	        is_dir($file)  && $dirsize += $this->calculateDirSize($file);
	    }

	    return $dirsize;
	}

	/**
	* @param DirectoryInterface $directory
	*
	* @return DirectoryInterface[]
	*/
	public function getDirectories(DirectoryInterface $directory) {
		
		$path = $directory->getPath().'/'.$directory->getName();
		
		if (! is_dir($path)) {
            return 0;
        }

		return glob($path.'/*', GLOB_ONLYDIR);

	}

}