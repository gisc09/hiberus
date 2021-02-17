<?php


namespace Hiberus\Sese\Api\Data;

use \Magento\Framework\Api\SearchResultsInterface;


interface ExamManagementSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Hiberus\Sese\Api\Data\ExamManagementInterface[]
     */
    public function getItems();

    /**
     * @param \Hiberus\Sese\Api\Data\ExamManagementInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}