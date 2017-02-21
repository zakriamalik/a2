<?php require('php/finCalcs.php'); ?>

<!Doctype html>
<html lang="en">
  <head>
    <!--head-->
    <title>Mortgage Calculator</title>
    <meta charset="utf-8" />
    <!--referenced css style libs-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

  </head>

<!--start of html body -->
  <body>
    <h1>Mortgage Calculator</h1>

    <Form method='GET' action='index.php'>
          <label for='loan'>Loan Amount:</label>
          <input type='text' name='loan' id='loan' value='<?=sanitize($loan)?>'></br>

          <label for='interestRate'>Interest Rate:</label>
          <input type='text' name='interestRate' id='interestRate' value='<?=sanitize($interestRate)?>'></br>

          <label for='timePeriodYearsTxt'>Select loan duration</label>
          <select name='timePeriodYearsTxt' id='timePeriodYearsTxt'>
              <option value='select_one'>Select one</option>
              <option value='15 yrs' <?php if($timePeriodYearsTxt == '15 yrs') echo 'SELECTED'?>>15 yrs</option>
              <option value='20 yrs' <?php if($timePeriodYearsTxt == '20 yrs') echo 'SELECTED'?>>20 yrs</option>
              <option value='25 yrs' <?php if($timePeriodYearsTxt == '25 yrs') echo 'SELECTED'?>>25 yrs</option>
              <option value='30 yrs' <?php if($timePeriodYearsTxt == '30 yrs') echo 'SELECTED'?>>30 yrs</option>
              <option value='35 yrs' <?php if($timePeriodYearsTxt == '35 yrs') echo 'SELECTED'?>>35 yrs</option>
              <option value='40 yrs' <?php if($timePeriodYearsTxt == '40 yrs') echo 'SELECTED'?>>40 yrs</option>
          </select></br>

          <label for='interestType'>Interest Type:</label>
          <label><input type='radio' name='interestType' value='fixed' <?php if($interestType == 'fixed') echo 'CHECKED'?>> Fixed</label>
          <label><input type='radio' name='interestType' value='variable' <?php if($interestType == 'variable') echo 'CHECKED'?>> Variable</label></br>
          <label><input type='checkbox' name='show_table' value='show_table' <?php if(isset($_GET['show_table'])) echo "CHECKED='CHECKED'"; ?> > Amortization Table</label></br>
                <!--http://stackoverflow.com/questions/12541419/php-keep-checkbox-checked-after-submitting-form-->
          <input type='submit' name='submit' class='btn btn-primary btn-small'>
          <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='../assignment2/index.php'" value='Reset Form'>
                    <!-- Rsetse Button - Got ideas from:  http://www.plus2net.com/html_tutorial/button-linking.php -->

          <?php if(isset($errors)): ?>
               <div class='alert alert-danger'>
                   <ul>
                     <?php $x=0; ?>
                       <?php foreach($errors as $error):?>
                            <?php $x++; ?>
                           <li><?=$x?>) <?=$error?></li>

                       <?php endforeach; ?>
                   </ul>
               </div>
           <?php endif; ?>

    </form>
<?php if($_GET && $x==0): ?>
    <div>
      <h2>Mortgage Information</h2>
      Loan Amount: $<?=number_format($loan , 2, '.', ',')?></br>
      Interest Type: <?=$interestType?></br>
      Interest Rate (Annual): <?=Round($interestRate,3)?>%<?php if($interestType=='fixed') {echo " (constant rate monthly)";} else {echo "( +-1% variable rate monthly)";}?></br>
      Interest Rate (Monthly): <?php if($interestType=='fixed') {echo Round($interestRate/12,3);} else {echo Round(($interestRate-1)/12,3); echo " - "; echo Round(($interestRate+1)/12,3);}?>%</br>
      Time in Months: <?=$timePeriodMonths?></br>
      Estimated Monthly Payment: $<?=number_format($monthlyPayment , 2, '.', ',')?></br></br>
    </div>
<?php endif; ?>

    <?php if(!empty($_GET['show_table'])) {
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
  </body>
</html>
