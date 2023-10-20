<?php
    // app/Services/ConvertDateService.php
    namespace App\Services;

    class ConvertDateTimeToDate
    {
        public function convertDateGeneral($convertDate)
        {
            $convertDateGeneral = date('Y-m-d', strtotime($convertDate));
    
            return $convertDateGeneral;
        }

        public function convertDateFrom($fromDate)
        {
            $dateFrom = date('Y-m-d', strtotime($fromDate));
    
            return $dateFrom;
        }

        public function convertDateTo($toDate)
        {
            $dateTo = date('Y-m-d', strtotime($toDate));
    
            return $dateTo;
        }
    }
?>