<?php
session_start();

echo "<h2>Danh sách các biến trong phiên:</h2>";
echo "<ul>";
foreach ($_SESSION as $key => $value) {
    echo "<li>$key: ";
    if (is_array($value)) {
        echo "<ul>";
        foreach ($value as $subkey => $subvalue) {
            echo "<li>$subkey: $subvalue</li>";
        }
        echo "</ul>";
    } else {
        echo $value;
    }
    echo "</li>";
}

var_dump($_SESSION);
echo "</ul>";
?>
