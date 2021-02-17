<?php
namespace Hiberus\Sese\Block\Adminhtml\Grid;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'id_exam';
        $this->_blockGroup = 'Hiberus_Sese';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->remove('reset');
        $this->buttonList->remove('delete');
    }

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save');
    }

}