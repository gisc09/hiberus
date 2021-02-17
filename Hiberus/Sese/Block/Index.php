<?php

namespace Hiberus\Sese\Block;

use Magento\Framework\View\Element\Template;
use Hiberus\Sese\Model\ExamManagementRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\Filter;

class Index extends Template
{
    /**
     * @var ExamManagementRepository $examManagementRepository
     */
    private $_examManagementRepository;

    /**
     * @var SearchCriteriaBuilder $searchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * @var SortOrder $sortOrder
     */
    private $_sortOrder;

    /**
     * @var Filter $filter
     */
    private $_filter;

    public function __construct(
        Template\Context $context,
        ExamManagementRepository $examManagementRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        Filter $filter,
        array $data = [])
    {
    $this->_examManagementRepository = $examManagementRepository;
    $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    $this->_sortOrder = $sortOrder;
    $this->_filter = $filter;
    parent::__construct($context, $data);
    }

    public function getStudentMarks()
    {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        if (count($list->getItems())):
            return $list->getItems();
        endif;

        return false;
    }

    public function getBestMark() {
        $sortOrder=$this->_sortOrder->setField('mark')->setDirection('DESC');
        $searchCriteria = $this->_searchCriteriaBuilder->setSortOrders([$sortOrder])->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        if (count($items=$list->getItems())):
            $studentInfo=reset($items);
            return $studentInfo->getMark();
        endif;

        return false;
    }

    public function getAverage() {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        if (count($list->getItems())):
           $average=array();
            foreach($list->getItems() as $studentInfo):
                array_push($average, $studentInfo->getMark());
            endforeach;
            return number_format(array_sum($average)/count($average), 2);
        endif;

        return false;
    }
    public function getBestThreeScoredMarks() {

        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        if (count($list->getItems())):
            $marks=array();
            foreach($list->getItems() as $studentInfo):
                array_push($marks, $studentInfo->getMark());
            endforeach;

            asort($marks);
            $arr = array_reverse($marks);
            return array_slice($arr, 0, 3);
        endif;

        return false;
    }

    public function isBestScore($studentInfo, $bestScores) {
        //$filter=$this->_filter->setField('id_exam')->setValue($studentInfo->getIdExam())->setConditionType('eq');
        $searchCriteria = $this->_searchCriteriaBuilder->addFilter('id_exam',$studentInfo->getIdExam())->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        $items=$list->getItems();
        $student=reset($items);
        $studenMark=$student->getMark();

        if(in_array($studenMark, $bestScores)):
            return true;
        endif;

        return false;
    }

}