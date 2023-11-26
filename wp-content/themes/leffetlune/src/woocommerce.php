<?php 
/**
 * Vérifie si on est sur une page liée à la boutique.
 *
 * @return boolean
 */
function is_commerce_related():bool
{
    return is_woocommerce() || is_cart() || is_checkout() || is_account_page();
}
?>