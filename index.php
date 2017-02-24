<?php require('php/finCalcs.php'); ?>

<!Doctype html>
<html lang="en">
  <head>
    <!--head-->
    <title>Mortgage Payment Calculator</title>
    <meta charset="utf-8" />
    <!--referenced css style libs-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

  </head>

<!--start of html body -->
  <body>
    <h2>Mortgage Payment Calculator</h2>
    <!--start of form -->
    <Form method='GET' action='index.php'>
          <!--text input box for loan amount entry -->
          <label for='loan'>Loan Amount:</label>
          <input type='number' step='0.01' min='1' name='loan' id='loan' value='<?=sanitize($loan)?>'><br/>

          <!--text input box for interest rate entry -->
          <label for='interestRate'>Interest Rate:</label>
          <input type='number' step='0.001' min='1.01' name='interestRate' id='interestRate' value='<?=sanitize($interestRate)?>'><br/>

          <!--option radio buttons for type of interest rate -->
          <b>Interest Type:</b>
          <label><input type='radio' name='interestType' value='fixed' <?php if($interestType == 'fixed') echo 'CHECKED'?>> Fixed</label>
          <label><input type='radio' name='interestType' value='variable' <?php if($interestType == 'variable') echo 'CHECKED'?>> Variable</label><br/>

          <!--select downdown for duration of loan in years -->
          <label for='loanDuration'>Select loan duration</label>
          <select name='loanDuration' id='loanDuration'>
              <option value='select_one'>Select one</option>
              <option value='15 yrs' <?php if($loanDuration == '15 yrs') echo 'SELECTED'?>>15 yrs</option>
              <option value='20 yrs' <?php if($loanDuration == '20 yrs') echo 'SELECTED'?>>20 yrs</option>
              <option value='25 yrs' <?php if($loanDuration == '25 yrs') echo 'SELECTED'?>>25 yrs</option>
              <option value='30 yrs' <?php if($loanDuration == '30 yrs') echo 'SELECTED'?>>30 yrs</option>
              <option value='35 yrs' <?php if($loanDuration == '35 yrs') echo 'SELECTED'?>>35 yrs</option>
              <option value='40 yrs' <?php if($loanDuration == '40 yrs') echo 'SELECTED'?>>40 yrs</option>
          </select><br/>

          <!--checkbox to show or hide amortization table -->
          <label><input type='checkbox' name='show_table' value='show_table' <?php if(isset($_GET['show_table'])) echo "CHECKED='CHECKED'"; ?> > Display Amortization Table</label><br/>
          <!--Technique used based on method used on this website: http://stackoverflow.com/questions/12541419/php-keep-checkbox-checked-after-submitting-form-->

          <!--submit & reset buttons -->
          <input type='submit' name='submit' class='btn btn-primary btn-small'>
          <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='index.php'" value='Reset Form'>
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
      <hr></hr>
        <div>
          <h2>Mortgage Information</h2>
          Loan Amount: $<?=$loanDisplay?><br/>
          Interest Rate (Annual): <?=$interestRateDisplay?><br/>
          Interest Rate (Monthly): <?=$interestRateMonthlyDisplay?><br/>
          Interest Type: <?=$interestType?><br/>
          Loan Duration : <?=$loanDuration?> (<?=$timePeriodMonths?> months)<br/>
          <h4>Estimated Monthly Payment: $<?=$monthlyPaymentDisplay?></h4>
        </div>
    <?php endif; ?>

    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <?php if(!empty($_GET['show_table']) && $_GET && $x==0): ?>
      <hr></hr>
        <div>
          <h2>Mortgage Amortization Schedule</h2>
          <?php include('php/amortSchDisp.php'); ?>
        </div>
    <?php endif; ?>


  </body>
</html>
