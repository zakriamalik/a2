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
    <!--start of form -->
    <Form method='GET' action='index.php'>
          <!--text input box for loan amount entry -->
          <label for='loan'>Loan Amount:</label>
          <input type='number' step='0.01' min='1' name='loan' id='loan' value='<?=sanitize($loan)?>'></br>

          <!--text input box for interest rate entry -->
          <label for='interestRate'>Interest Rate:</label>
          <input type='number' step='0.001' min='1.01' name='interestRate' id='interestRate' value='<?=sanitize($interestRate)?>'></br>

          <!--select downdown for duration of loan in years -->
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

          <!--option radio buttons for type of interest rate -->
          <label for='interestType'>Interest Type:</label>
          <label><input type='radio' name='interestType' value='fixed' <?php if($interestType == 'fixed') echo 'CHECKED'?>> Fixed</label>
          <label><input type='radio' name='interestType' value='variable' <?php if($interestType == 'variable') echo 'CHECKED'?>> Variable</label></br>

          <!--checkbox to show or hide amortization table -->
          <label><input type='checkbox' name='show_table' value='show_table' <?php if(isset($_GET['show_table'])) echo "CHECKED='CHECKED'"; ?> > Display Amortization Table</label></br>
          <!--Technique used based on method used on this website: http://stackoverflow.com/questions/12541419/php-keep-checkbox-checked-after-submitting-form-->

          <!--submit & reset buttons -->
          <input type='submit' name='submit' class='btn btn-primary btn-small'>
          <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='../assignment2/index.php'" value='Reset Form'>
          <!--Technique for reset button, got ideas from Piazza forum and this website:  http://www.plus2net.com/html_tutorial/button-linking.php -->

          <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
          <?php $x=0; if($errors): ?>
               <div class='alert alert-danger'>
                   <ul>
                       <?php foreach($errors as $error): $x++;?>
                           <li><?=$x?>) <?=$error?></li>
                       <?php endforeach; ?>
                   </ul>
               </div>
           <?php endif; ?>
    </form>

    <!--conditional display of entry/input values and some converted values based on formulae in logic file (soc)-->
    <?php if($_GET && $x==0): ?>
        <div>
          <h2>Mortgage Information</h2>
          Loan Amount: $<?=$loanDisplay?></br>
          Interest Type: <?=$interestType?></br>
          Interest Rate (Annual): <?=$interestRateDisplay?></br>
          Interest Rate (Monthly): <?=$interestRateMonthlyDisplay?></br>
          Time in Months: <?=$timePeriodMonths?></br>
          Estimated Monthly Payment: $<?=$monthlyPaymentDisplay?></br></br>
        </div>
    <?php endif; ?>

    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <?php if(!empty($_GET['show_table']) && $_GET && $x==0): ?>
        <div>
          <h2>Mortgage Information</h2>
          <?php include('php/amortTable.php'); ?>
        </div>
    <?php endif; ?>


  </body>
</html>
