cd %~dp0
call start /min "服务器进程请勿关闭" .\php\php.exe -S localhost:8008 -t . &
start key.html
.\php\php.exe look.php
