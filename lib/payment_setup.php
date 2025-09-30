<?php

function updateDatabaseForPayments() {
    global $db;
    
    // Read the SQL file
    $sql = file_get_contents(dirname(__FILE__) . '/../../admin/database/payment_update.sql');
    
    try {
        // Execute the SQL
        $db->exec($sql);
        return true;
    } catch (PDOException $e) {
        // Check if columns already exist (to handle multiple runs)
        if (strpos($e->getMessage(), "Duplicate column name") !== false) {
            return true; // Already updated
        }
        error_log("Error updating database for payments: " . $e->getMessage());
        return false;
    }
}
