DROP TABLE IF EXISTS expense;
DROP TABLE IF EXISTS detail;
DROP TABLE IF EXISTS budget;

CREATE TABLE budget (
budget_category varchar(120) NOT NULL primary key,
amount money NOT NULL
);

CREATE TABLE detail (
store_name varchar(120) NOT NULL primary key,
budget_category varchar(120) NOT NULL references budget(budget_category)
);

CREATE TABLE expense (
expense_id serial NOT NULL primary key,
store_name varchar(120) NOT NULL references detail(store_name),
transaction_amount money NOT NULL,
purchase_date date NOT NULL
);