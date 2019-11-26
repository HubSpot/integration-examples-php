alter table invitations add created_at DATETIME not null DEFAULT CURRENT_TIMESTAMP after text;
