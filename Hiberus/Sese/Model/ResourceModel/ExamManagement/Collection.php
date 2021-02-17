<?php
namespace Hiberus\Sese\Model\ResourceModel\ExamManagement;

use Hiberus\Sese\Model\ExamManagement as ModelExamManagement;
use Hiberus\Sese\Model\ResourceModel\ExamManagement as ResourceModelExamManagement;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id_exam';

    /**
     * Initialize resource model collection
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ModelExamManagement::class, ResourceModelExamManagement::class);
    }

}