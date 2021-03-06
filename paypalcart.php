<?php if (!defined('PmWiki')) exit();

$RecipeInfo['PayPalCart']['Version'] = '2016-06-13';


#Define PayPal Add to Cart button markup
Markup_e('AddToCart', 'inline',  '/\\(:AddToCart (.*?):\\)/', 'PayPalAddToCart("$m[1]")');

function PayPalAddToCart($opts) {
	global $PayPal_Account;
  $args = ParseArgs($opts);
  $output = "<form target='paypal' action='https://www.paypal.com/cgi-bin/webscr' method='post'>\n"
	. "<input type='hidden' name='add' value='1'>\n"
	. "<input type='hidden' name='cmd' value='_cart'>\n"
	. "<input type='hidden' name='business' value='$PayPal_Account' />\n"
	. "<input type='hidden' name='item_name' value='".$args['name']."' />\n"
	. "<input type='hidden' name='item_number' value='".$args['id']."' />\n"
	. "<input type='hidden' name='amount' value='".$args['amount']."' />\n"
	. "<input type='hidden' name='no_note' value='1' />\n"
	. "<input type='hidden' name='currency_code' value='USD' />\n"
	. "<input type='hidden' name='lc' value='US'>";
	$output .= "<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-but22.gif'\n"
	. "border='0' name='submit' alt='Make payments with PayPal - it's fast, free and secure!'>\n"
	. "<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>\n"
	. "</form>";
	return Keep($output);
}

#Define PayPal View Cart button markup
Markup_e('ViewCart', 'inline',  '/\\(:ViewCart:\\)/', 'PayPalViewCart()');

function PayPalViewCart() {
	global $PayPal_Account;
	$output = "<form target='paypal' action='https://www.paypal.com/cgi-bin/webscr' method='post'>\n"
	. "<input type='hidden' name='cmd' value='_cart'>\n"
	. "<input type='hidden' name='business' value='$PayPal_Account'>\n"
	. "<input type='image' src='https://www.paypal.com/images/view_cart.gif' border='0' \n"
	. "name='submit' alt='Make payments with PayPal - it's fast, free and secure!'>\n"
	. "<input type='hidden' name='display' value='1'></form>";
	return Keep($output);
}