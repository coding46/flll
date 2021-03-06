<?php
namespace FluidTYPO3\Flll\LanguageFile;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Claus Due <claus@namelesscoder.net>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package Flll
 * @subpackage LanguageFile
 */
class XliffLanguageFile extends AbstractLanguageFile implements LanguageFileInterface {

	/**
	 * Writes collected labels to file; uses stored filename if one exists,
	 * otherwise fails to write. Throws \FluidTYPO3\LanguageFile\Exception
	 * on errors; returns TRUE on success.
	 *
	 * @return boolean
	 * @throws Exception
	 */
	public function write() {
		foreach ($this->newLabels as $definition) {
			$this->languageFileService->writeLanguageLabel($this->getFilename(), $definition);
		}
	}

}
