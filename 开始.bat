cd %~dp0
call start /min "��������������ر�" .\php\php.exe -S localhost:8008 -t . &
start key.html
.\php\php.exe look.php
