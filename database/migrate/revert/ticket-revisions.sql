-- Revert kawaii:ticket-revisions from pg

BEGIN;

ALTER TABLE kawaii.tickets
ADD COLUMN title text;

ALTER TABLE kawaii.tickets
ADD CONSTRAINT ticket_revisions_title_not_empty
    CHECK (title !~ '^\s*$');

ALTER TABLE kawaii.tickets
ADD COLUMN facts text;

UPDATE kawaii.tickets
SET title = ticket_revisions_1.title,
    facts = ticket_revisions_1.facts
FROM kawaii.ticket_revisions AS ticket_revisions_1
WHERE ticket_revisions_1.revision = (
    SELECT max(ticket_revisions_2.revision)
    FROM kawaii.ticket_revisions AS ticket_revisions_2
    WHERE ticket_revisions_2.ticket_id = ticket_revisions_1.ticket_id
);

ALTER TABLE kawaii.tickets
ALTER COLUMN title SET NOT NULL;

ALTER TABLE kawaii.tickets
ALTER COLUMN facts SET NOT NULL;

DROP TABLE kawaii.ticket_revisions;

COMMIT;
