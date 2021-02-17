<?php
namespace Hiberus\Sese\Block\Adminhtml\Grid\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Hiberus\Sese\Model\ExamManagement $examManagement,
        array $data = []
    )
    {
        $this->_examManagement = $examManagement;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('exam');
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('hiberus_sese_');
        if ($model->getIdExam()) {
            $fieldset = $form->addFieldset(
                'exam',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id_exam', 'hidden', ['name' => 'id_exam']);
        } else {
            $fieldset = $form->addFieldset(
                'id_exam',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $form->addField(
            'firstname',
            'text',
            [
                'name' => 'firstname',
                'label' => __('Firstname'),
                'id' => 'firstname',
                'title' => __('Firstname'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $form->addField(
            'lastname',
            'text',
            [
                'name' => 'lastname',
                'label' => __('Lastname'),
                'id' => 'lastname',
                'title' => __('Lastname'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $form->addField(
            'mark',
            'text',
            [
                'name' => 'mark',
                'label' => __('Mark'),
                'id' => 'mark',
                'title' => __('Mark'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}