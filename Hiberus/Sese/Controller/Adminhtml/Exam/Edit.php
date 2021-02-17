<?php


namespace Hiberus\Sese\Controller\Adminhtml\Exam;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Hiberus\Sese\Model\ExamManagementFactory;
use Magento\Backend\App\Action\Context;


class Edit extends Action
{
    private $_examManagementFactory;
    private $coreRegistry;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ExamManagementFactory $examManagementFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->_examManagementFactory = $examManagementFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id_exam');
        $examData = $this->_examManagementFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($id):
            $examData = $examData->load($id);
            if (!$examData->getIdExam()):
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('*/*/index');
                return;
            endif;
        endif;

        $this->coreRegistry->register('exam', $examData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $id ? __('Edit Exam information of: ').$examData->getFirstname().' '.$examData->getLastname() : __('Add Exam Information');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}