<?php

namespace Hiberus\Sese\Model;

use Hiberus\Sese\Api\Data\ExamManagementInterface;
use Hiberus\Sese\Model\ResourceModel\ExamManagement as ResourceModelExamManagement;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class ExamManagement extends AbstractExtensibleModel implements ExamManagementInterface, IdentityInterface
{

    const CACHE_TAG = 'hiberus_sese_entity';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'hiberus_sese_entity';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'hiberus_sese_entity';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelExamManagement::class);
    }

    /**
     * @inheritdoc
     */
    public function getIdExam()
    {
        return $this->_getData(self::HIBERUS_EXAM_ID_EXAM);
    }

    /**
     * @inheritdoc
     */
    public function setIdExam($id_exam)
    {
        return $this->setData(self::HIBERUS_EXAM_ID_EXAM, $id_exam);
    }

    /**
     * @inheritdoc
     */
    public function getFirstname()
    {
        return $this->_getData(self::HIBERUS_EXAM_FIRSTNAME);
    }

    /**
     * @inheritdoc
     */
    public function setFirstname($firstName)
    {
        return $this->setData(self::HIBERUS_EXAM_FIRSTNAME, $firstName);
    }

    /**
     * @inheritdoc
     */
    public function getLastname()
    {
        return $this->_getData(self::HIBERUS_EXAM_LASTNAME);
    }

    /**
     * @inheritdoc
     */
    public function setLastname($lasttName)
    {
        return $this->setData(self::HIBERUS_EXAM_LASTNAME, $lasttName);
    }

    /**
     * @inheritdoc
     */
    public function getMark()
    {
        return $this->_getData(self::HIBERUS_EXAM_MARK);
    }

    /**
     * @inheritdoc
     */
    public function setMark($mark)
    {
        return $this->setData(self::HIBERUS_EXAM_MARK, $mark);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

}