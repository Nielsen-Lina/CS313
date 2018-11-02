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
company_name varchar(120) NOT NULL,
category_id serial NOT NULL references budget(category_id)
);

CREATE TABLE expense (
expense_id serial NOT NULL primary key,
detail_id serial NOT NULL references detail(detail_id),
transaction_amount money NOT NULL,
purchase_date date NOT NULL
);

INSERT INTO budget VALUES (1, 'Income', -6000), (2, 'Transportation', 800), (3, 'Housing', 1500), (4, 'Savings', 1000), (5, 'Utilities', 400), (6, 'Health Care', 200), (7, 'Consumer Debt', 1500), (8, 'Food and Grocery', 300), (9, 'Entertainment', 300);
INSERT INTO detail(company_name, category_id) VALUES ('Bosch', 1), ('Chase Car Loan', 2), ('AAA', 2), ('Shell', 2), ('Chase Mortgage', 3), ('BellTire', 2), ('Chase Savings', 4), ('Vanguard', 4), ('Comcast', 5), ('T-Mobile', 5), ('DTE', 5), ('BCBS', 6), ('Chase Credit Card', 7), ('Citi Credit Card', 7), ('Kroger', 8), ('Costco', 8), ('Meijer', 8), ('AMC', 9), ('Netflix', 9), ('Apple Vacation', 9); 
INSERT INTO expense(detail_id, transaction_amount, purchase_date) VALUES (2, 300,'01 Oct 2018'), (1, -6100, '01 Oct 2018'), (8, 500, '01 Oct 2018'), (7, 500, '01 Oct 2018'), (5, 1500, '03 Oct 2018'), (15, 100, '05 Oct 2018'), (16, 80, '05 Oct 2018');

CREATE USER new_user WITH PASSWORD 'new_pass';
GRANT SELECT, INSERT, UPDATE, DELETE ON budget AND detail AND expense TO new_user;