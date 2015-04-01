create database if not exists WinGear character set utf8 collate utf8_unicode_ci;
use WinGear;

grant all privileges on WinGear.* to 'WinGear_user'@'localhost' identified by 'secret';
