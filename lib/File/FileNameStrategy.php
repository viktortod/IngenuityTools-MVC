<?php
	namespace File;
	/**
	 * Provides the interface of the naming strategy
	 * @abstract
	 * @author Viktor Todorov
	 */
	interface FileNameStrategy {
		/**
		 * Commits the name of the file
		 * @param array $fileInfo information about the filename
		 * @return string the filename
		 * @abstract
		 */
		public function nameFile(array $fileInfo);
	}