<?php

require('php/tools.php');
require('php/Form.php');

$form = new DWA\Form($_GET);
if($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'loan' => 'float|min:1|max:10000000',
            'interestRate' => 'float|min:1|max:25',
						'loan' => 'numbersOnly',
						'interestType' => 'required',
						'timePeriodYearsTxt' => 'chooseOne'
        ]
    );
}



$loan = (isset($_GET['loan'])) ? $_GET['loan'] : '';
$interestRate = (isset($_GET['interestRate'])) ? $_GET['interestRate'] : '';
//$timePeriodYears = (isset($_GET['timePeriodYears'])) ? $_GET['timePeriodYears'] : '';

$timePeriodYearsTxt='';
$timePeriodYears=0;
if(isset($_GET['timePeriodYearsTxt'])) {
	$timePeriodYearsTxt = $_GET['timePeriodYearsTxt'];
    if($timePeriodYearsTxt == 'select_one') {
        $alertType = 'alert-danger';
        $results = 'Please choose a day.';
    }
    else {
        $alertType = 'alert-info';
        $results = 'You selected '.$timePeriodYearsTxt;

              if($timePeriodYearsTxt == '15 yrs') {
                  $timePeriodYears = 15;
              }
              elseif($timePeriodYearsTxt == '20 yrs') {
                $timePeriodYears = 20;
              }
              elseif($timePeriodYearsTxt == '25 yrs') {
                $timePeriodYears = 25;
              }
              elseif($timePeriodYearsTxt == '30 yrs') {
                $timePeriodYears = 30;
              }
              elseif($timePeriodYearsTxt == '35 yrs') {
                $timePeriodYears = 35;
              }
              elseif($timePeriodYearsTxt == '40 yrs') {
                $timePeriodYears = 40;
              }
              else {
                  $timePeriodYears = 10;
              }
        }

    }


if($_GET) {
    $_GET = sanitize($_GET);
}


if(isset($_GET['interestType'])) {
	$interestType = $_GET['interestType'];
}
else {
	$interestType = 'No Interest Type was selected';
}

if($interestRate>0 && $timePeriodYears>0 && $loan>0) {
		$interestRateMonthly = ($interestRate/100)/12; #https://www.mtgprofessor.com/formulas.htm
		$timePeriodMonths = $timePeriodYears*12;
		$monthlyPayment = $loan*($interestRateMonthly*(1 + $interestRateMonthly)**$timePeriodMonths)/(((1 + $interestRateMonthly)**$timePeriodMonths) - 1); #http://php.net/manual/en/language.operators.arithmetic.php
		# Mortage Payment Formula: P = L[c(1 + c)^n]/[(1 + c)^n - 1]
		# Remaining Balance Formula: B = L[(1 + c)^n - (1 + c)^p]/[(1 + c)^n - 1]
		# Where: L = Loan amount, c=monthly interest rate=Annual Interest Rate/12, P = Monthly payment, n = Month when the balance is paid in full, B = Remaining Balance
	}
?>
