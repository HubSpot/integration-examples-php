create table user
(
    telegram_chat_id int not null,
    email varchar(255) default null null,
    constraint users_pk
        primary key (telegram_chat_id)
);
