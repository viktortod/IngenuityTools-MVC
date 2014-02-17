<?php
	namespace File\Strategy;
	
	use File\FileNameStrategy;
	/**
	 * Generates filename using current timestamp and the original filename
	 * @author Viktor Todorov
	 * @see \File\FileNameStrategy
	 * @see \File\UploadedFile
	 * @final
	 */
	final class TimestampNameStrategy implements FileNameStrategy { 
		/**
		 * @see File.FileNameStrategy::nameFile()
		 */
		public function nameFile(array $fileInfo){
			return time(). $fileInfo['name'];
		}
	}