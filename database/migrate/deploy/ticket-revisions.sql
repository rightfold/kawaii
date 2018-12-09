-- Deploy kawaii:ticket-revisions to pg

BEGIN;

CREATE TABLE kawaii.ticket_revisions (
    ticket_id   uuid    NOT NULL,
    revision    int     NOT NULL,

    title       text    NOT NULL,
    facts       text    NOT NULL,

    CONSTRAINT ticket_revisions_pk
        PRIMARY KEY (ticket_id, revision),

    CONSTRAINT ticket_revisions_ticket_id_fk
        FOREIGN KEY (ticket_id)
        REFERENCES kawaii.tickets
        ON DELETE CASCADE,

    CONSTRAINT ticket_revisions_revision_positive
        CHECK (revision >= 1),

    CONSTRAINT ticket_revisions_title_not_empty
        CHECK (title !~ '^\s*$')
);

GRANT SELECT, INSERT, UPDATE, DELETE
    ON TABLE kawaii.ticket_revisions
    TO kawaii_application;

INSERT INTO kawaii.ticket_revisions (ticket_id, revision, title, facts)
SELECT id, 1, title, facts
FROM kawaii.tickets;

ALTER TABLE kawaii.tickets
DROP COLUMN title;

ALTER TABLE kawaii.tickets
DROP COLUMN facts;

COMMIT;
