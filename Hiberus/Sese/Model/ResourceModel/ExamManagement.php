<?php

namespace Hiberus\Sese\Model\ResourceModel;

use Hiberus\Sese\Api\Data\ExamManagementInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ExamManagement extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ExamManagementInterface::TABLE, ExamManagementInterface::HIBERUS_EXAM_ID_EXAM);
    }
}