<?php
namespace Tsc\CatStorageSystem\Factory\Structure;

use \DateTimeInterface;
use Tsc\CatStorageSystem\Factory\Contracts\FileInterface;
use Tsc\CatStorageSystem\Factory\Contracts\DirectoryInterface;

/**
 * 
 */
class File implements FileInterface
{
	/**
     * @var String File Name
     */
	protected $file_name;
	
	/**
     * @var String File Size
     */
	protected $file_size;
	
	/**
     * @var  DateTime
     */
	protected $file_created_time;
	
	/**
     * @var DateTime
     */
	protected $file_modified_time;
	
	/**
     * @var String Parent Directory
     */
	protected $parent_directory;
	
	/**
     * @var String file path
     */
	protected $file_path;
	

	

	/**
   	* @return string
  	*/
  	public function getName() {
  		return $this->file_name;
  	}


	/**
	* @param string $name
	*
	* @return $this
	*/
	public function setName($name){
  		$this->file_name = $name;
		return $this;
	}
	

	/**
	* @return int
	*/
	public function getSize(){
  		return $this->file_size;
	}
	

	/**
	* @param int $size
	*
	* @return $this
	*/
	public function setSize($size){
		$this->file_size = $size;
		return $this;
	}
	

	/**
	* @return DateTime
	*/
	public function getCreatedTime(){
		return $this->file_created_time;
	}
	

	/**
	* @param DateTimeInterface $created
	*
	* @return $this
	*/
	public function setCreatedTime(DateTimeInterface $created){
		$this->file_created_time = $created->format('Y-m-d H:i:s');
		return $this;
	}
	

	/**
	* @return DateTimeInterface
	*/
	public function getModifiedTime(){
		return $this->file_modified_time;	
	}
	

	/**
	* @param DateTimeInterface $modified
	*
	* @return $this
	*/
	public function setModifiedTime(DateTimeInterface $modified){
		$this->file_modified_time = $modified->format('Y-m-d H:i:s');
		return $this;
	}
	

	/**
	* @return DirectoryInterface
	*/
	public function getParentDirectory(){
		return $this->parent_directory;
	}
	

	/**
	* @param DirectoryInterface $parent
	*
	* @return $this
	*/
	public function setParentDirectory($parent){
		$this->parent_directory = $parent;
		return $this;
	}

	/**
	* @return string
	*/
	public function getPath(){
		return $this->file_path;
	}

	/**
	* @param string $path
	*
	* @return $this
	*/
	public function setPath($path) {
		$this->file_path = $path;
		return $this;
	}

}