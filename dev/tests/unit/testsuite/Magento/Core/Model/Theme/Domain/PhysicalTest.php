<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

/**
 * Test theme domain physical model
 */
namespace Magento\Core\Model\Theme\Domain;

class PhysicalTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateVirtualTheme()
    {
        $physicalTheme = $this->getMock('Magento\Core\Model\Theme', ['__wakeup'], [], '', false, false);
        $physicalTheme->setData(['parent_id' => 10, 'theme_title' => 'Test Theme']);

        $copyService = $this->getMock('Magento\Theme\Model\CopyService', ['copy'], [], '', false, false);
        $copyService->expects($this->once())->method('copy')->will($this->returnValue($copyService));

        $virtualTheme = $this->getMock(
            'Magento\Core\Model\Theme',
            ['__wakeup', 'getThemeImage', 'createPreviewImageCopy', 'save'],
            [],
            '',
            false,
            false
        );
        $virtualTheme->expects($this->once())->method('getThemeImage')->will($this->returnValue($virtualTheme));

        $virtualTheme->expects(
            $this->once()
        )->method(
            'createPreviewImageCopy'
        )->will(
            $this->returnValue($virtualTheme)
        );

        $virtualTheme->expects($this->once())->method('save')->will($this->returnValue($virtualTheme));

        $themeFactory = $this->getMock('Magento\Core\Model\ThemeFactory', ['create'], [], '', false, false);
        $themeFactory->expects($this->once())->method('create')->will($this->returnValue($virtualTheme));

        $themeCollection = $this->getMock(
            'Magento\Core\Model\Resource\Theme\Collection',
            ['addTypeFilter', 'addAreaFilter', 'addFilter', 'count'],
            [],
            '',
            false,
            false
        );

        $themeCollection->expects($this->any())->method('addTypeFilter')->will($this->returnValue($themeCollection));

        $themeCollection->expects($this->any())->method('addAreaFilter')->will($this->returnValue($themeCollection));

        $themeCollection->expects($this->any())->method('addFilter')->will($this->returnValue($themeCollection));

        $themeCollection->expects($this->once())->method('count')->will($this->returnValue(1));

        $domainModel = new \Magento\Core\Model\Theme\Domain\Physical(
            $this->getMock('Magento\Framework\View\Design\ThemeInterface', [], [], '', false, false),
            $themeFactory,
            $copyService,
            $themeCollection
        );
        $domainModel->createVirtualTheme($physicalTheme);
    }
}
