DROP DATABASE IF EXISTS MakeMeRichBank;
CREATE DATABASE MakeMeRichBank;
USE MakeMeRichBank;

--
CREATE TABLE BankAccount
(
  AccountID int NOT NULL PRIMARY KEY,
  Description varchar(200),
  Balance decimal(8,2) -- 999999.99 to -999999.99 
);

-- Insert test data
INSERT INTO BankAccount (AccountID, Description, Balance) VALUES (1, 'Savings Account', 1000.00);
INSERT INTO BankAccount (AccountID, Description, Balance) VALUES (2, 'Spendings Account', 0.00);


