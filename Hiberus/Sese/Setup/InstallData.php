<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hiberus\Sese\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\File\Csv;
use Magento\Framework\Filesystem\DirectoryList;
use Hiberus\Sese\Model\ExamManagementFactory;
use Hiberus\Sese\Model\ResourceModel\ExamManagement;
/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var Csv
     */
    private $csvParser;

    /**
     * @var File
     */
    private $fileDriver;

    /**
     * @var DirectoryList
     */
    private $dir;

    /**
     * @var ExamManagementFactory
     */
    private $examManagementFactory;

    /**
     * @var ExamManagement
     */
    private $examManagement;

    /**
     * InstallData constructor.
     * @param File $fileDriver
     * @param Csv $csvParser
     * @param DirectoryList $dir
     */
    public function __construct(
       File $fileDriver,
       Csv $csvParser,
       DirectoryList $dir,
       ExamManagementFactory $examManagementFactory,
       ExamManagement $examManagement
    ) {
        $this->fileDriver = $fileDriver;
        $this->csvParser = $csvParser;
        $this->dir = $dir;
        $this->examManagementFactory = $examManagementFactory;
        $this->examManagement = $examManagement;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        /**
         * Get students from csv file
         */
        $file = $this->dir->getPath('var').'/import/students.csv';
        if (file_exists($file)):

            $students=array();
            $csvData = $this->csvParser->getData($file);

            foreach($csvData as $dataLine):
                $studentInfo=[
                    'firstname' => $dataLine[0],
                    'lastname' => $dataLine[1],
                    'mark' => $this->getRandomMark()
                ];
            array_push($students, $studentInfo);
            endforeach;

            foreach($students as $student):
                $newStudent = $this->examManagementFactory->create();
                $newStudent->setFirstname($student['firstname']);
                $newStudent->setLastname($student['lastname']);
                $newStudent->setMark($student['mark']);
                $this->examManagement->save($newStudent);
            endforeach;
        endif;

    }

    private function getRandomMark() {
        $scale = pow(10, 2);
        $randomMrak=mt_rand((1 * $scale), (10 * $scale)) /$scale;
        return number_format($randomMrak,2);
    }
}