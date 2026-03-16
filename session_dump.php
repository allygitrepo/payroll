<?php
if(!isset($_SESSION)) { session_start(); }
echo "PHP SESSION: <pre>";
print_r($_SESSION);
echo "</pre>";

// Also check CI session if possible
require_once 'index.php'; // This might be tricky
?>
