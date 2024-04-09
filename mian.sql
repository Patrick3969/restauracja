CREATE TABLE user (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(20),
    password VARCHAR(20)
);

CREATE TABLE stoliki (
    stolikiID INT AUTO_INCREMENT PRIMARY KEY,
);

CREATE TABLE rezerwacje (
    rezerwacjaID INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    godzina_rezerwacji TIME,
    liczba_osob INT,
    stolikiID INT,
    userID INT,
    FOREIGN KEY (stolikiID) REFERENCES stoliki(stolikiID),
    FOREIGN KEY (userID) REFERENCES user(userID)
);
