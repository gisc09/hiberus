<?php

namespace Hiberus\Sese\Console\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hiberus\Sese\Model\ExamManagementRepository;

class HiberusSese extends Command
{
    /**
     * @var SearchCriteriaBuilder $searchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * @var ExamManagementRepository $examManagementRepository
     */
    private $_examManagementRepository;

    public function __construct(
        string $name = null,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ExamManagementRepository $examManagementRepository
    )
    {
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_examManagementRepository = $examManagementRepository;
        parent::__construct($name);
    }

    protected function configure() {
        $this->setName('hiberus:sese');
        $this->setDescription('Show all fields of hiberus_exam database table');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $list = $this->_examManagementRepository->getList($searchCriteria);

        if (count($list->getItems())):
            $output->writeln('|                     Students Marks Table                    |');
            $output->writeln('---------------------------------------------------------------');
            foreach($list->getItems() as $student):
                $output->writeln('| '.$student->getFirstname().' '.$student->getLastname().' | '.$student->getMark().' |');
            endforeach;
        endif;

    }


}