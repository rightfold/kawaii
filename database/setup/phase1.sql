CREATE ROLE kawaii_application
    LOGIN
    PASSWORD 'kawaii_application';

CREATE ROLE kawaii_sqitch
    LOGIN
    PASSWORD 'kawaii_sqitch';

CREATE DATABASE kawaii
    OWNER kawaii_sqitch;
