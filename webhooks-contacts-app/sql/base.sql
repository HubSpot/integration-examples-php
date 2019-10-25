create table if not exists events
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_type  VARCHAR(255),
    object_id   int        default null,
    event_id    int        default null,
    occurred_at bigint     default null,
    shown       tinyint(1) default 0,
    created_at  datetime   default CURRENT_TIMESTAMP
);
