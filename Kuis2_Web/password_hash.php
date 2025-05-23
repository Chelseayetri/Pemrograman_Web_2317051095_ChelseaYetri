<?php
$password = 'tes1234';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password hash untuk '$password' adalah:\n$hash\n";
