alter table events add propertyName varchar(255) after occurred_at;
alter table events add propertyValue varchar(255) after propertyName;
