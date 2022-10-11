-- create a database senzorserver with a user senzorserverapp and password SenzorServerApp2022

CREATE USER 'senzorserverapp'@'%' IDENTIFIED BY 'SenzorServerApp2022';
GRANT USAGE ON *.* TO 'senzorserverapp'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `senzorserverapp`;
GRANT ALL PRIVILEGES ON `senzorserverapp`.* TO 'senzorserverapp'@'%';