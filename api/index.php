<?php
// File ini mencegah akses direktangsung ke api folder
header('HTTP/1.0 403 Forbidden');
die('Access Denied');
?>
