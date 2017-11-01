-- drop the table if it already exists
DROP TABLE IF EXISTS attribute;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS list;

-- this is the table for lists
CREATE TABLE list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
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

-- insert some records
INSERT INTO list (name) VALUES ('Soccer players');
INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Lionel Messi', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 0, 'club', 'text', 'FC Barcelona');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 1, 'national team', 'text', 'Argentina');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 2, 'video', 'video', "<iframe src='https://www.youtube.com/embed/0NQL3qZKrTE' frameborder='0' allowfullscreen></iframe>");
INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Neymar Jr.', 1);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 0, 'club', 'text', 'PSG');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 1, 'national team', 'text', 'Brazil');