<?php
//The VAT rate.
$vat = 40;
 
//Divisor (for our math).
$vatDivisor = 1 + ($vat / 100);
 
//The gross price, including VAT.
$price = 35;
 
//Determine the price before VAT.
$priceBeforeVat = $price / $vatDivisor;
 
//Determine how much of the gross price was VAT.
$vatAmount = $price - $priceBeforeVat;
 
//Print out the price before VAT.
echo "Before Tax". number_format($priceBeforeVat, 2), '<br>';
 
//Print out how much of the gross price was VAT.
echo 'all @ ' . $vat . '% - ' . number_format($vatAmount, 2), '<br>';
 
//Print out the gross price.
//echo $price;
?>