GRANT ALL ON *.* TO 'app'@'%';

GRANT REPLICATION SLAVE ON *.* TO 'app_slave'@'%' IDENTIFIED BY 'password';