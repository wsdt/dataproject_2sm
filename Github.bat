@echo off
:retry
cls
color a
title © Riedl Kevin - Github Pusher 
echo.
echo *********************** Github Pusher ***********************
echo.
echo git add .
echo git commit -m [your message]
echo git push
echo ( git pull https://github.com/wsdt/dataproject_2sm.git )
echo.
set files=.
set /p "files=File to be added [. for whole project]: "

if "%files%" equ "." echo WARNING: ALL FILES ARE GOING TO BE OVERWRITTEN!!!
echo.
set message=%date%_%username%
set /p "message=Your Commit-Message: "

git add %files%
git commit -m "%message%"
git push
echo.
set "works=Y"
echo Did it work? [Y/N]
set /p works=[--- 
REM Update/Merge local repository, then push your own changes. 
if /i "%works%"=="N" git pull https://github.com/wsdt/dataproject_2sm.git&timeout 5&goto retry
pause >nul
exit
