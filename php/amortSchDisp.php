
<?php
# Display file to show amortization table schedule
#Reference: Got ideas about tables from this website and developed code: http://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array
echo "<table id='tblAmortSchedule'>"; #Table declaration & generation
echo "<tr>
          <th>Pmt No</th>
          <th>Loan Amount ($)</th>
          <th>Interest Rate Monthly (%)</th>
          <th>Monthly Payment ($)</th>
          <th>Interest ($)</th>
          <th>Principal ($)</th>
          <th>Loan Balance ($)</th>
       </tr>"; #Table header

 #$loanRemTbl=$loan;
 # Run a loop iterating from first monthly payment to the last (based on the number of months in the loan term)
 for($i = 1; $i <= $timePeriodMonths && $loan>0; $i++) {
 $loanRemTbl = $loan;
 include('php/amortSchLog.php');
# Table rows 'tr' with columns 'td'. The table is populated dynamically as the loop runs from first payment to last
echo "<tr> \n\r";
echo "<td>".$i."</td>";
echo "<td>".$loanRemTbl."</td>";
echo "<td>".$interestRateTbl."</td>";
echo "<td>".$monthlyPmtTbl."</td>";
echo "<td>".$interestPmtTbl."</td>"; #see reference 1 below
echo "<td>".$principalPmtTbl."</td>";
echo "<td>".$loanBalTbl."</td>"; #see reference 2 below
echo "</tr>";
}
echo "</table>";
echo "*Last row represents the remaining balance, if +ive money is owed to bank, if -ive consumer gets refund.";
#Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
#Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
?>
