<?php
session_start();
// Set some session data

// Generate a JSON response that includes the session data
header('Content-Type: application/json');
echo json_encode($_SESSION["contacts"]);
?>