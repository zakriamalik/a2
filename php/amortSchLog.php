<?php
# Logic file to calculate amortization table schedule
# if condition to check up on fixed interest rate verses variable
# if fixed, use entered rate, if variable, use random numbers +-1 entered rate
if($interestType=='fixed'){
    $interestRateMonthly=$interestRateMonthly;
}
else {
    $interestRateMonthly=(rand($interestRate*100+100,$interestRate*100-100))/10000/12;
}
# logical calculations for the table to be passed on to the display file
$loanRemTbl = number_format($loanRemTbl, 2, '.', ',');
$interestRateTbl = number_format($interestRateMonthly*100, 2, '.', ',');
$monthlyPmtTbl = number_format($monthlyPayment, 2, '.', ',');
$interestPmtTbl = number_format($loan*$interestRateMonthly, 2, '.', ','); #see reference 1 below
$principalPmtTbl = number_format($monthlyPayment-$loan*$interestRateMonthly, 2, '.', ',');
$loan = $loan-($monthlyPayment-$loan*$interestRateMonthly); #see reference 2 below
$loanBalTbl = number_format($loan, 2, '.', ',');
#Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
#Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
?>
