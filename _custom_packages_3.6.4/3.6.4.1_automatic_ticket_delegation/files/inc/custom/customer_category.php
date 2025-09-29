<?php
/**
 * HESK Plus 3.6.4.1 - Customer Category Assignment
 * 
 * This file contains the logic to automatically assign ticket categories
 * based on the customer's default category setting.
 * 
 * @package HESK Plus
 * @version 3.6.4.1
 */

/* Check if this is a valid include */
if (!defined('IN_SCRIPT')) {die('Invalid attempt');}

/**
 * Get the default category for a customer based on their email
 * 
 * @param string $email Customer email address
 * @return int|null Category ID if found, null for default category
 */
function hesk_get_category_for_customer($email) {
    global $hesk_settings;

    // DEBUG POINT 4: Email limpo
    $email_original = $email;
    $email = strtolower(trim($email));
    file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
        "\n[DEBUG 4] Email original: '$email_original' | Email limpo: '$email' | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
    
    if (empty($email)) {
        file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
            "\n[DEBUG 4] Email vazio, retornando NULL | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
        return null;
    }

    // DEBUG POINT 5: Query SQL
    $sql = "SELECT `customer_category` FROM `".hesk_dbEscape($hesk_settings['db_pfix'])."customers` WHERE `email` = '".hesk_dbEscape($email)."' AND `customer_category` IS NOT NULL LIMIT 1";
    file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
        "\n[DEBUG 5] SQL: $sql | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
    
    $res = hesk_dbQuery($sql);
    
    // DEBUG POINT 6: Resultado da query
    $num_rows = hesk_dbNumRows($res);
    file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
        "\n[DEBUG 6] Num rows: $num_rows | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
    
    if ($num_rows) {
        $row = hesk_dbFetchAssoc($res);
        $category = intval($row['customer_category']);
        file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
            "\n[DEBUG 6] Categoria encontrada: $category | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
        return $category;
    }
    
    file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/debug_customer_category.txt', 
        "\n[DEBUG 6] Nenhuma categoria encontrada, retornando NULL | Timestamp: " . date('Y-m-d H:i:s'), FILE_APPEND);
    return null; // Fallback to default category
}
