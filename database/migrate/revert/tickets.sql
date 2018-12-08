-- Revert kawaii:tickets from pg

BEGIN;

DROP TABLE kawaii.tickets;

COMMIT;
