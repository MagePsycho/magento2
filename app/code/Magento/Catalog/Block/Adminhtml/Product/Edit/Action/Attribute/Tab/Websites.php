<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

/**
 * Product mass attribute update websites tab
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Catalog\Block\Adminhtml\Product\Edit\Action\Attribute\Tab;

use Magento\Store\Model\Group;
use Magento\Store\Model\Website;

class Websites extends \Magento\Backend\Block\Widget implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @return Website[]
     */
    public function getWebsiteCollection()
    {
        return $this->_storeManager->getWebsites();
    }

    /**
     * @param Website $website
     * @return Group[]
     */
    public function getGroupCollection(Website $website)
    {
        return $website->getGroups();
    }

    /**
     * @param Group $group
     * @return array
     */
    public function getStoreCollection(Group $group)
    {
        return $group->getStores();
    }

    /**
     * Tab settings
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Websites');
    }

    /**
     * @return string
     */
    public function getTabTitle()
    {
        return __('Websites');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
