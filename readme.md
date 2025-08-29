
# Webdev
- username if0_39451327
- Mot de passe IL4OVE5PIZ3ZA1


# Sprint 1

# Generation de la bdd 

CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    profile_picture VARCHAR(255),
    profile_description TEXT
);

CREATE TABLE Stamp (
    stamp_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,                  -- depuis le sprint 0 jai rajout/ ca
    name VARCHAR(255) NOT NULL,
    description TEXT,
    starting_price DECIMAL(10,2) NOT NULL,
    `condition` VARCHAR(100),
    dimensions VARCHAR(100),
    country_of_origin VARCHAR(100),
    colours VARCHAR(255),
    is_certified BOOLEAN DEFAULT FALSE,
    collection VARCHAR(100),
    image_url VARCHAR(255), 
    CONSTRAINT fk_stamp_user FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

CREATE TABLE Auction (
    auction_id INT AUTO_INCREMENT PRIMARY KEY,
    stamp_id INT NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    status VARCHAR(50),
    CONSTRAINT fk_auction_stamp FOREIGN KEY (stamp_id) REFERENCES Stamp(stamp_id) ON DELETE CASCADE
);

CREATE TABLE Bid (
    bid_id INT AUTO_INCREMENT PRIMARY KEY,
    auction_id INT NOT NULL,
    user_id INT NOT NULL,
    bid_amount DECIMAL(10,2) NOT NULL,
    bid_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_bid_auction FOREIGN KEY (auction_id) REFERENCES Auction(auction_id) ON DELETE CASCADE,
    CONSTRAINT fk_bid_user FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

CREATE TABLE News (
    news_id INT AUTO_INCREMENT PRIMARY KEY,
    picture VARCHAR(255),
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL
);
