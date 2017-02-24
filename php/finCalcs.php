<?php

require('php/tools.php');
require('php/Form.php');

#Intantiating Class Form
$form = new DWA\Form($_GET);

#Validation Script (Leveraged the code shared in the class lectures)
$errors=[];
if($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'loan' => 'required|float|min:1|max:10000000',
            'interestRate' => 'required|float|min:1|max:25',
            'loanDuration' => 'chooseOne',
            'interestType' => 'required'
        ]
    );
}


#Run the Sanitize Function from Tools.php to cleanse the form input values
if($_GET) {
    $_GET = sanitize($_GET);
}

#Load up input variables & Initialize where needed
$loan = (isset($_GET['loan'])) ? $_GET['loan'] : '';
$interestRate = (isset($_GET['interestRate'])) ? $_GET['interestRate'] : '';
$loanDuration='';
$interestType='';
$monthlyPayment=0;

#Handling of Select Dropdown Values (Leveraged the code shared in the class lectures)
#Assigning values to variable based on selection made
if(isset($_GET['loanDuration'])) {
	$loanDuration = $_GET['loanDuration'];
    if($loanDuration == 'select_one') {
        $timePeriodYears = 0;
    }
    elseif($loanDuration == '15 yrs') {
        $timePeriodYears = 15;
    }
    elseif($loanDuration == '20 yrs') {
        $timePeriodYears = 20;
    }
    elseif($loanDuration == '25 yrs') {
        $timePeriodYears = 25;
    }
    elseif($loanDuration == '30 yrs') {
        $timePeriodYears = 30;
    }
    elseif($loanDuration == '35 yrs') {
        $timePeriodYears = 35;
    }
    elseif($loanDuration == '40 yrs') {
        $timePeriodYears = 40;
    }
}

#Handling of option radio input and assignment of selected values to variable.
if(isset($_GET['interestType'])) {
	$interestType = $_GET['interestType'];
}

#Logic: Formulae & Calculations used to determine mortage payments
if($interestRate>0 && $timePeriodYears>0 && $loan>0) {
		$interestRateMonthly = ($interestRate/100)/12;
		$timePeriodMonths = $timePeriodYears*12;
		$monthlyPayment = $loan*($interestRateMonthly*(1 + $interestRateMonthly)**$timePeriodMonths)/(((1 + $interestRateMonthly)**$timePeriodMonths) - 1);
    #Reference: Learned and leveraged arithematic functions used at this website: http://php.net/manual/en/language.operators.arithmetic.php
    #Reference: Obatined Mortage Loan Payment formualae from this website: https://www.mtgprofessor.com/formulas.htm
    #Mortage Payment Formula: P = L[c(1 + c)^n]/[(1 + c)^n - 1]
		#Where: L = Loan amount, c=monthly interest rate=Annual Interest Rate/12, P = Monthly payment, n = Month when the balance is paid in full, B = Remaining Balance
	}

	#variable to display the Loan Amount after form submission, data format being performed
	$loanDisplay = number_format(floatval($loan), 2, '.', ',');

	#variable to display the interest rate using logic based on interest type
	if($interestType=='fixed') {
		$interestRateDisplay = Round($interestRate,3).'% (constant rate monthly)';}
		else {
		$interestRateDisplay = Round($interestRate,3).'% ( +-1% variable rate monthly)';}
    #Self defined rule that if variable rate is selected, it would be within +-1% of the interest rate entered

	#variable to display the interest rate in monthly terms after from submission, based on interest type
	if($interestType=='fixed') {
		$interestRateMonthlyDisplay = Round($interestRate/12,3).'%';}
		else {
		$interestRateMonthlyDisplay = Round(($interestRate-1)/12,3).' - '.Round(($interestRate+1)/12,3).'%';}
    #Self defined rule that if variable rate is selected, it would be within +-1% of the interest rate entered

		#variable to display the estimated monthly payment after form submission, data format being performed
		$monthlyPaymentDisplay = number_format(floatval($monthlyPayment), 2, '.', ',');
?>
