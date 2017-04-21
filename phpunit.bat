@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0vendor\bin\/../phpunit/phpunit/phpunit
php "%BIN_TARGET%" %*
