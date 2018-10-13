DROP TABLE IF EXISTS expense;
DROP TABLE IF EXISTS detail;
DROP TABLE IF EXISTS budget;

CREATE TABLE budget (
category_id serial NOT NULL primary key,
category_name varchar(120) NOT NULL,
amount money NOT NULL
);

CREATE TABLE detail (
detail_id serial NOT NULL primary key,
store_name varchar(120) NOT NULL,
category_id serial NOT NULL references budget(category_id)
);

CREATE TABLE expense (
expense_id serial NOT NULL primary key,
detail_id serial NOT NULL references detail(detail_id),
transaction_amount money NOT NULL,
purchase_date date NOT NULL
);

