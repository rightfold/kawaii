-- Deploy kawaii:schema to pg

BEGIN;

CREATE SCHEMA kawaii;

GRANT USAGE
    ON SCHEMA kawaii
    TO kawaii_application;

COMMIT;
