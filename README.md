# assignment 2
# This assignment is about a Mortgage Calculator. The key intent is to provide a utility to a user to help determine estimated mortgage payment upon entry of certain inputs like loan amount, duration, interest rate, and type. 
# Another feature is the Mortgage Amortization Schedule. This is a table that helps determines the load payment schedule with visibility into the components of mortgage payment and a burn-down table down to zero loan amount. 
# Known Conditions:
# 1) The Loan amount range is from $1 to $10 million
# 2) The interest rate range is from 1% to 25%
# 3) The load duration is from 15 yrs to 40 yrs term
# 4) If the interest rate type is fixed, calculator would use the entered interest rate as fixed throughout the schedule.
# 4) If the interest rate type is variable, calculator would use the entered interest rate as seed to determine random interest rates +-1% entered.
# 4) The interest rate type does not impact the monthly payment which is fixed for this calculator, but the application to the amortization schedule is updated as the interest rate changes from month to month. This results in either paying loan early or paying a large lump sum residual at the last payment
# A checkbox is provided in order to show the loan amortization schedule.
# Reset button is provided to clear all entries and begin from scratch
