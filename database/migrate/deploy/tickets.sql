-- Deploy kawaii:tickets to pg

BEGIN;

CREATE TABLE kawaii.tickets (
    id      uuid    NOT NULL,

    title   text    NOT NULL,
    facts   text    NOT NULL,

    CONSTRAINT tickets_pk
        PRIMARY KEY (id),

    CONSTRAINT tickets_title_not_empty
        CHECK (title !~ '^\s*$')
);

GRANT SELECT, INSERT, UPDATE, DELETE
    ON TABLE kawaii.tickets
    TO kawaii_application;

COMMIT;
