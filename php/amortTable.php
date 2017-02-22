
<?php

if(!empty($_GET['show_table'])) {
#$interestType='Variable';
echo "<table id='tblAmortSchedule'>"; #http://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array
echo "<tr>
          <th>Pmt No</th>
          <th>Loan Amount ($)</th>
          <th>Interest Rate Monthly (%)</th>
          <th>Monthly Payment ($)</th>
          <th>Interest ($)</th>
          <th>Principal ($)</th>
          <th>Loan Balance ($)</th>
       </tr>";
$results = '';
for($i = 1; $i <= $timePeriodMonths && $loan>0; $i++) {
$results .= $i.' ';
if($interestType=='fixed'){
    $interestRateMonthly=$interestRateMonthly;
}
else {
    $interestRateMonthly=(rand($interestRate*100+100,$interestRate*100-100))/10000/12;
}
echo "<tr> \n\r";
echo "<td>".$i."</td>";
echo "<td>".number_format($loan, 2, '.', ',')."</td>";
echo "<td>".number_format($interestRateMonthly*100, 2, '.', ',')."</td>";
echo "<td>".number_format($monthlyPayment, 2, '.', ',')."</td>";
echo "<td>".number_format($loan*$interestRateMonthly, 2, '.', ',')."</td>"; #http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
echo "<td>".number_format($monthlyPayment-$loan*$interestRateMonthly, 2, '.', ',')."</td>";
echo "<td>".number_format($loan = $loan-($monthlyPayment-$loan*$interestRateMonthly), 2, '.', ',')."</td>"; #http://php.net/manual/en/function.number-format.php
echo "</tr>";
}
echo "</table>";
echo "Last row represents the remaining balance, if +ive money is owed to bank, if -ive consumer gets refund.";
}
?>
