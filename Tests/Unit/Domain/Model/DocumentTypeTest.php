<?php

namespace EWW\Dpf\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
 *
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
 * Test case for class \EWW\Dpf\Domain\Model\DocumentType.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DocumentTypeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \EWW\Dpf\Domain\Model\DocumentType
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \EWW\Dpf\Domain\Model\DocumentType();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMetadataPageReturnsInitialValueForMetadataPage() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getMetadataPage()
		);
	}

	/**
	 * @test
	 */
	public function setMetadataPageForObjectStorageContainingMetadataPageSetsMetadataPage() {
		$metadataPage = new \EWW\Dpf\Domain\Model\MetadataPage();
		$objectStorageHoldingExactlyOneMetadataPage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneMetadataPage->attach($metadataPage);
		$this->subject->setMetadataPage($objectStorageHoldingExactlyOneMetadataPage);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneMetadataPage,
			'metadataPage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addMetadataPageToObjectStorageHoldingMetadataPage() {
		$metadataPage = new \EWW\Dpf\Domain\Model\MetadataPage();
		$metadataPageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$metadataPageObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($metadataPage));
		$this->inject($this->subject, 'metadataPage', $metadataPageObjectStorageMock);

		$this->subject->addMetadataPage($metadataPage);
	}

	/**
	 * @test
	 */
	public function removeMetadataPageFromObjectStorageHoldingMetadataPage() {
		$metadataPage = new \EWW\Dpf\Domain\Model\MetadataPage();
		$metadataPageObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$metadataPageObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($metadataPage));
		$this->inject($this->subject, 'metadataPage', $metadataPageObjectStorageMock);

		$this->subject->removeMetadataPage($metadataPage);

	}
}
