<?php


namespace Hiberus\Sese\Model;

use Hiberus\Sese\Api\Data\ExamManagementSearchResultsInterface;
use Hiberus\Sese\Api\Data\ExamManagementSearchResultsInterfaceFactory;
use Hiberus\Sese\Api\ExamManagementRepositoryInterface;
use Hiberus\Sese\Model\ResourceModel\ExamManagement\Collection;
use Hiberus\Sese\Model\ResourceModel\ExamManagement\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Hiberus\Sese\Model\ExamManagementFactory;
use Hiberus\Sese\Api\Data\ExamManagementInterface;
use Hiberus\Sese\Model\ResourceModel\ExamManagement as ResourceModelExamManagement;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Exception;

class ExamManagementRepository implements ExamManagementRepositoryInterface
{

    /**
     * @var CollectionFactory
     */
    private $_examManagementCollectionFactory;

    /**
     * @var ExamManagementSearchResultsInterfaceFactory
     */
    private $_examManagementSearchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;

    /**
     * @var ExamManagementFactory
     */
    private $_examManagementFactory;

    /**
     * @var ResourceModelExamManagement
     */
    private $_resourceModelExamManagement;


    /**
     * ExamManagementRepository constructor.
     * @param CollectionFactory $examManagementCollectionFactory
     * @param ExamManagementSearchResultsInterfaceFactory $examManagementSearchResultsInterfaceFactory
     */
    public function __construct(
        CollectionFactory $examManagementCollectionFactory,
        ExamManagementSearchResultsInterfaceFactory $examManagementSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        ExamManagementFactory $examManagementFactory,
        ResourceModelExamManagement $resourceModelExamManagement
    ) {
        $this->_examManagementCollectionFactory = $examManagementCollectionFactory;
        $this->_examManagementSearchResultsInterfaceFactory = $examManagementSearchResultsInterfaceFactory;
        $this->_collectionProcessor = $collectionProcessor;
        $this->_examManagementFactory = $examManagementFactory;
        $this->_resourceModelExamManagement = $resourceModelExamManagement;
    }


    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->_examManagementCollectionFactory->create();
        $this->_collectionProcessor->process($searchCriteria, $collection);


        /** @var ExamManagementSearchResultsInterface $searchResults */
        $searchResults = $this->_examManagementSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function getById($entityId)
    {
        return $this->get($entityId);
    }

    /**
     * @inheritdoc
     */
    public function get($value, $attributeCode = null)
    {
        /** @var ExamManagement $entity */
        $entity = $this->_examManagementFactory->create()->load($value, $attributeCode);

        if (!$entity->getIdExam()) {
            throw new NoSuchEntityException(__('Unable to find entity'));
        }

        return $entity;
    }

    public function deleteById($entityId)
    {
        $entity = $this->getById($entityId);

        return $this->delete($entity);
    }

    /**
     * @inheritdoc
     */
    public function delete(ExamManagementInterface $entity)
    {

        $entityId = $entity->getIdExam();
        try {
            $this->_resourceModelExamManagement->delete($entity);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __('Unable to remove entity %1', $entityId)
            );
        }

        return true;
    }
}