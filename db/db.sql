-- Table for users
CREATE TABLE user(
	userID INTEGER PRIMARY KEY AUTOINCREMENT,
	user TEXT,
	display TEXT,
	pass TEXT,
	groups TEXT
);

-- Table for groups
CREATE TABLE groups(
	groupID INTEGER PRIMARY KEY AUTOINCREMENT,
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

CREATE TABLE invite(
	by TEXT,
	user TEXT,
	accept BOOL DEFAULT FALSE,
	co BOOL DEFAULT FALSE
); -- For handling invites
