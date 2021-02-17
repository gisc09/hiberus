<?php


namespace Hiberus\Sese\Controller\Adminhtml\Exam;

use Magento\Backend\App\Action;
use Hiberus\Sese\Model\ExamManagementFactory;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    /**
     * @var \Hiberus\Sese\Model\ExamManagementFactory $examManagementFactory
     */
    private $_examManagementFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Hiberus\Sese\Model\ExamManagementFactory $examManagementFactory
     */
    public function __construct(
        Context $context,
        ExamManagementFactory $examManagementFactory
    ) {
        parent::__construct($context);
        $this->_examManagementFactory = $examManagementFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/index');
            return;
        }
        try {
            $rowData = $this->_examManagementFactory->create();
            $rowData->setData($data);
            if (isset($data['id_exam'])) {
                $rowData->setIdExam($data['id_exam']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }
}