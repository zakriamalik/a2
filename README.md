# Assignment 2
# This assignment is about a Mortgage Payment Calculator. The key intent is to provide a utility to a user to help determine estimated mortgage payment upon entry of certain required inputs like loan amount, duration, interest rate, and type.
# Another feature is the Mortgage Amortization Schedule. This is a table that helps determines the loan payment schedule with visibility into the components of mortgage payment (interest and principal) and a burn-down table from start initial loan amount down to zero loan amount.
# Specifications & Conditions:
# 1) The Loan amount is a numerical entry with a range from $1 to $10 million
# 2) The interest rate is also a numerical entry with a range from 1% to 25%, fractions up to three decimal spaces are accepted
# 3) The loan duration is from 15 yrs to 40 yrs term, with 5 yr increments offered via dropdown
# 4) If the interest rate type is fixed, calculator would use the entered interest rate as fixed throughout the amortization schedule.
# 5) If the interest rate type is variable, calculator would use the entered interest rate as a seed to determine random interest rates +-1% as entered.
# 6) The interest rate type does not impact the monthly payments which are made fixed for this calculator, but the application to the amortization schedule is updated as the interest rate changes from month to month. This results in either paying loan early or paying a large lump sum residual in the last payment
# 7) A checkbox is provided in order to show the loan amortization schedule in conjuction with submit button
# 8) Reset button is provided to clear all entries and begin entries from scratch
