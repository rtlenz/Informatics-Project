
DROP TABLE IF EXISTS attribute;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS list;
DROP TABLE IF EXISTS template;
DROP TABLE IF EXISTS follow;
DROP TABLE IF EXISTS templateAttribute;


CREATE TABLE list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
	account_username VARCHAR(255) NOT NULL,
	template_id NOT NULL,
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
CREATE TABLE follow(
	id INT NOT NULL AUTO_INCREMENT,
	followerid INT NOT NULL,
	followedid INT NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE template(
	id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id)
);
CREATE TABLE templateAttribute(
	id INT NOT NULL AUTO_INCREMENT,
	template_id INT NOT NULL,
	text VARCHAR(255) NOT NULL,
	image VARCHAR(255) NOT NULL,
	video VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);

-- insert some records
INSERT INTO list (name,account_username)  VALUES ('Baseball Players','rtlenz');
INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Frank Thomas', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 0, 'Team', 'text', 'Chicago White Sox');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 1, 'Postiton', 'text', '1B/DH');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 2, 'video', 'video', "<iframe src='https://www.youtube.com/embed/qWrwOrjIkS4' frameborder='0' allowfullscreen></iframe></iframe>");
INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Mike Trout', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 0, 'Team', 'text', 'Los Angelas Angels');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 1, 'Postiton', 'text', 'CF');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 2, 'video', 'video', "<iframe src='https://www.youtube.com/embed/bgjbzV4mUVc' frameborder='0' allowfullscreen></iframe>");
INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Jose Altuve', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (3, 0, 'Team', 'text', 'Houston Astros');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (3, 1, 'Postiton', 'text', '2B');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (3, 2, 'video', 'video', "<iframe src='https://www.youtube.com/embed/x2FfruQZfhg' frameborder='0' allowfullscreen></iframe>");


INSERT INTO list (name,account_username)  VALUES ('Football Players','rtlenz');
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Odell Beckham Jr.', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 0, 'Team', 'text', 'New York Giants');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 1, 'Postiton', 'text', 'WR');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 2, 'video', 'video', "<iframe  src='https://www.youtube.com/embed/zxbz3DDQzHU' frameborder='0' allowfullscreen></iframe>");
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Jordan Howard', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (5, 0, 'Team', 'text', 'Chicago Bears');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (5, 1, 'Postiton', 'text', 'RB');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (5, 2, 'video', 'video', "<iframe  src='https://www.youtube.com/embed/iejVxd0i6hg' frameborder='0' allowfullscreen></iframe>");
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Tom Brady', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (6, 0, 'Team', 'text', 'New England Patriots');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (6, 1, 'Postiton', 'text', 'QB');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (6, 2, 'video', 'video', "<iframe  src='https://www.youtube.com/embed/3-SAA3aK0eI' frameborder='0' allowfullscreen></iframe>");


