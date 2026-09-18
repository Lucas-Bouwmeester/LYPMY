-- Table for users
CREATE TABLE user(
	userID INT PRIMARY KEY,
	user TEXT,
	display TEXT,
	pass TEXT,
	groups TEXT
);

-- Table for groups
CREATE TABLE groups(
	groupID INT PRIMARY KEY,
	owner INT,
	name TEXT,
	desc TEXT,
	members TEXT,
	picture TEXT,
	blacklist TEXT
);

CREATE TABLE message(
	by INT,
	cont TEXT
); -- For storing group messages
