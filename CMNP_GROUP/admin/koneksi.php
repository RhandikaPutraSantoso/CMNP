<?php
$host = "172.16.1.2:30015"; // IP dan port database SAP HANA 
$user = "SYSTEM";
$pass = "P@ssw0rd";

// DSN-less connection string
$dsn = "odbc:Driver={HDBODBC};ServerNode=$host;";

try
{
    // Create a new PDO instance
    $koneksi = new PDO($dsn, $user, $pass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set the PDO error mode to exception
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>