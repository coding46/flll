<?php
namespace FluidTYPO3\Flll\LanguageFile;

/**
 * Dynamic Language Label Accessor
 *
 * Writes any LLL labels that do not exist, in file
 * that should contain them. Labels already set are
 * simply returned as-is, without modifying the file.
 *
 * @package Flll
 */
class DynamicLabelAccessor implements \ArrayAccess, \Iterator {

	/**
	 * @var array
	 */
	protected $labels = array();

	/**
	 * @var LanguageFileInterface
	 */
	protected $file;

	/**
	 * @param LanguageFileInterface $file
	 * @return void
	 */
	public function setFile($file) {
		$this->file = $file;
	}

	/**
	 * @param array $labels
	 * @return void
	 */
	public function load($labels) {
		$this->labels = $labels;
	}

	/**
	 * @param mixed $offset
	 * @return boolean
	 */
	public function offsetExists($offset) {
		// offsets -always- exist even if they are not set; returning
		// TRUE makes outside accessors call offsetGet() for any index
		// which then triggers internal checking if the index must also
		// be written to the file set in $this->filename
		return TRUE;
	}

	/**
	 * @param mixed $offset
	 * @return mixed
	 */
	public function offsetGet($offset) {
		if (FALSE === isset($this->labels[$offset])) {
			$this->file->add($offset, $offset);
			$this->labels[$offset] = $offset;
		}
		return $this->labels[$offset];
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 */
	public function offsetSet($offset, $value) {
		$this->labels[$offset] = $value;
	}

	/**
	 * @param mixed $offset
	 * @return void
	 */
	public function offsetUnset($offset) {
		unset($this->labels[$offset]);
	}

	/**
	 * @return mixed Can return any type.
	 */
	public function current() {
		return current($this->labels);
	}

	/**
	 * @return void
	 */
	public function next() {
		next($this->labels);
	}

	/**
	 * @return mixed scalar on success, or null on failure.
	 */
	public function key() {
		key($this->labels);
	}

	/**
	 * @return boolean
	 */
	public function valid() {
		$max = count($this->labels);
		$current = current($this->labels);
		$stack = array_values($this->labels);
		$index = array_search($current, $stack);
		return ($index < ($max - 1));
	}

	/**
	 * @return void
	 */
	public function rewind() {
		reset($this->labels);
	}
}
