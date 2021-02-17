<?php


namespace Hiberus\Sese\Controller\Adminhtml\Exam;


use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Setup\Exception;
use Magento\Ui\Component\MassAction\Filter;
use Hiberus\Sese\Model\ResourceModel\ExamManagement\CollectionFactory;
use Magento\Backend\App\Action;
use Hiberus\Sese\Model\ExamManagement;

class Delete extends Action
{
    /**
     * @var ExamManagement
     */
    protected $_examManagement;

    /**
     * @param Context $context
     * @param ExamManagement $examManagement
     */
    public function __construct(
        Context $context,
        ExamManagement $examManagement
    )
    {
        parent::__construct($context);
       $this->_examManagement = $examManagement;
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id_exam');
        if($id):
            $this->_examManagement->load($id)->delete();
            $this->messageManager->addSuccess(__('Exam record has been deleted.'));

            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath('*/*/');
        endif;

        $this->messageManager->addWarningMessage(__('No exam record has been deleted.'));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');

    }
}