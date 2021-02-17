<?php

namespace Hiberus\Sese\Plugin;

class ChangeMark
{
    public function afterGetStudentMarks(\Hiberus\Sese\Block\Index $subject, $result)
    {
        $newMarks=array();
        foreach($result as $studentInfo):
            if($studentInfo->getMark() < 5):
                $studentInfo['mark'] = 4.9;
            endif;
            array_push($newMarks, $studentInfo);
        endforeach;
        return $newMarks;
    }
}