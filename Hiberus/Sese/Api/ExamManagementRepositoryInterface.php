<?php

namespace Hiberus\Sese\Api;

Interface ExamManagementRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hiberus\Sese\Api\Data\ExamManagementSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}