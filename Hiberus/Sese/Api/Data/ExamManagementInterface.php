<?php

namespace Hiberus\Sese\Api\Data;

interface ExamManagementInterface
{
    const TABLE = 'hiberus_exam';
    const HIBERUS_EXAM_ID_EXAM = 'id_exam';
    const HIBERUS_EXAM_FIRSTNAME = 'firstname';
    const HIBERUS_EXAM_LASTNAME = 'lastname';
    const HIBERUS_EXAM_MARK = 'mark';

    /**
     * Retrieve the exam ID
     *
     * @return int
     */
    public function getIdExam();

    /**
     * Set exam ID
     *
     * @param int $id_exam
     * @return $this
     */
    public function setIdExam($id_exam);

    /**
     * Retrieve the student firstname
     *
     * @return string
     */
    public function getFirstname();

    /**
     * Set student firstname
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstname($firstName);

    /**
     * Retrieve the student lastname
     *
     * @return string
     */
    public function getLastname();

    /**
     * Set student lastname
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastname($lastName);

    /**
     * Retrieve the student mark
     *
     * @return float
     */
    public function getMark();

    /**
     * Set student mark
     *
     * @param float $mark
     * @return $this
     */
    public function setMark($mark);



}