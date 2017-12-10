DROP TABLE IF EXISTS attribute;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS list;
DROP TABLE IF EXISTS vote;



CREATE TABLE list (
    id INT NOT NULL AUTO_INCREMENT,
    listName VARCHAR(120) NOT NULL,
	accountid INT NOT NULL,
	voteCount INT NOT NULL,
	privacy VARCHAR(120) NOT NULL,
	timeCreated TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE item (
    id INT NOT NULL AUTO_INCREMENT,
    list_id INT NOT NULL,
    name VARCHAR(120) NOT NULL,
    ordernumber INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE attribute (
    id INT NOT NULL AUTO_INCREMENT,
    item_id INT NOT NULL,
    ordernumber INT NOT NULL,
    label VARCHAR(120) NOT NULL,
    type VARCHAR(120) NOT NULL,
    value VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)    
);


CREATE TABLE vote(
	vote_id INT NOT NULL AUTO_INCREMENT,
	accountid INT NOT NULL,
	list_id INT NOT NULL,
	vote INT NOT NULL,
	PRIMARY KEY (vote_id)
);
