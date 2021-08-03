<?php
namespace Tsc\CatStorageSystem\Factory\Structure;

use \DateTimeInterface;
use Tsc\CatStorageSystem\Factory\Contracts\DirectoryInterFace;

/**
 * 
 */
class Directory implements DirectoryInterFace
{
	/**
     * @var String Dir Name
     */
	private $directory_name;
	
	/**
     * @var String datetime
     */
	private $directory_created_time;
	
	/**
     * @var String path
     */
	private $directory_path;
	

	/**
	* @return string
	*/
	public function getName() {
		return $this->directory_name;
	}


	/**
	* @param string $name
	*
	* @return $this
	*/
	public function setName($name) {
		$this->directory_name = $name;
		return $this;
	}


	/**
	* @return DateTimeInterface
	*/
	public function getCreatedTime() {
		return $this->directory_created_time;
	}


	/**
	* @param DateTimeInterface $created
	*
	* @return $this
	*/
	public function setCreatedTime(DateTimeInterface $created) {
		$this->directory_created_time = $created->format('Y-m-d H:i:s');
		return $this;
	}


	/**
	* @return string
	*/
	public function getPath() {
		return $this->directory_path;
	}


	/**
	* @param string $path
	*
	* @return $this
	*/
	public function setPath($path) {
		$this->directory_path = $path;
		return $this;
	}

}