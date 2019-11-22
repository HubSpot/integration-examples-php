create table if not exists eventTypes
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    code        VARCHAR(255) unique not null,
    hubspotEventTypeId bigint unique not null
);

create table if not exists invitations
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) not null,
    text        text not null
);
