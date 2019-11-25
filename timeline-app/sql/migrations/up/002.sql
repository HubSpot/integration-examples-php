create table if not exists event_types
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    code        VARCHAR(255) unique not null,
    hubspot_event_type_id bigint unique not null
);

create table if not exists invitations
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) not null,
    text        text not null
);
