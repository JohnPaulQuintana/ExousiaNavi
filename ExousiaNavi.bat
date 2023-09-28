@REM @echo off
@REM cd /d "C:\Users\Info_Tech2022\Desktop\ExousiaNavi" 
@REM npm run dev
@REM php artisan serve --host=127.0.0.1 --port=8000


@REM working but terminal is visible
@echo off
@REM cd /d "C:\Users\Info_Tech2022\Desktop\ExousiaNavi"

@REM Start npm run dev in the background (assuming it's a long-running process)
@REM start /min "" npm run dev

@REM Wait for a few seconds (adjust the delay as needed)
@REM timeout /t 5

@REM Start php artisan serve in a new command prompt window
@REM start /min cmd /c php artisan serve --host=127.0.0.1 --port=8000

@REM Wait for a moment to ensure the PHP server starts
@REM timeout /t 5

@REM Open the URL in the default web browser
@REM start "" http://127.0.0.1:8000


@echo off

REM Get the directory of the batch script
for %%I in (%0) do set "script_dir=%%~dpI"

REM Change to the directory of the batch script
cd /d "%script_dir%"

REM Start Apache and MySQL using XAMPP command-line tool
"C:\xampp\xampp_start.exe" apache && "C:\xampp\xampp_start.exe" mysql

REM Wait for a few seconds to allow services to start (adjust the delay as needed)
timeout /t 5

REM Start npm run dev in the background (assuming it's a long-running process)
start /min "" npm run dev

REM Wait for a few seconds (adjust the delay as needed)
timeout /t 5

REM Start php artisan serve in a new command prompt window
start /min cmd /c php artisan serve --host=127.0.0.1 --port=8000

REM Wait for a moment to ensure the PHP server starts
timeout /t 5

REM Open the URL in the default web browser
start "" http://127.0.0.1:8000



