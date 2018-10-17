DROP TABLE IF EXISTS notes;
DROP TABLE IF EXISTS speakers;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS conferences;
DROP TABLE IF EXISTS users;

DROP TYPE IF EXISTS session_day;
CREATE TYPE session_day AS ENUM ('Saturday Morning', 'Saturday Afternoon', 'Saturday Evening', 'Sunday Morning', 'Sunday Afternoon');


CREATE TABLE users(

name varchar(120) NOT NULL,

password varchar(128) NOT NULL,

userID serial NOT NULL primary key

);


CREATE TABLE conferences(

conferenceID serial NOT NULL primary key,

month varchar(20) NOT NULL,

year int NOT NULL

);

CREATE TABLE sessions(
sessionID serial NOT NULL primary key,
conferenceID serial NOT NULL references conferences(conferenceID),
day session_day NOT NULL
);



CREATE TABLE speakers(

speakerID serial NOT NULL primary key,

sessionID serial NOT NULL references sessions(sessionID),

speakerName varchar(64) NOT NULL

);



CREATE TABLE notes(

userID serial NOT NULL references users(userID),

note text NOT NULL,

sessionID serial NOT NULL references sessions(sessionID),

speakerID serial NOT NULL references speakers(speakerID),

noteID serial NOT NULL primary key

);


INSERT INTO users(name,password) VALUES('Lina', 'Awesome');
INSERT INTO users(name,password) VALUES('Wendi', 'Awesome');

INSERT INTO conferences(month, year) VALUES(10, 2018);
INSERT INTO sessions(conferenceID, day) VALUES(
	currval(pg_get_serial_sequence('conferences','conferenceid')), 
	'Saturday Morning'
);

INSERT INTO speakers(sessionID, speakerName) VALUES( currval(pg_get_serial_sequence('sessions','sessionid')), 'President Nelson');

INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'2 hour church!!!!!!'
);
INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'12 temples!!!'
);

INSERT INTO speakers(sessionID, speakerName) VALUES( currval(pg_get_serial_sequence('conferences','conferenceid')), 'President Eyering');
INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'Hard things'
);
INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'The Lord trusts you'
);

INSERT INTO sessions(conferenceID, day) VALUES(
	currval(pg_get_serial_sequence('conferences','conferenceid')), 
	'Sunday Morning'
);

INSERT INTO speakers(sessionID, speakerName) VALUES( currval(pg_get_serial_sequence('conferences','conferenceid')), 'Elder Holland');
INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'Forgiving past'
);

INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	currval(pg_get_serial_sequence('speakers','speakerid')),
	'Do not dig things up!!!'
);
INSERT INTO notes(userID, sessionID, speakerID, note) VALUES(
	currval(pg_get_serial_sequence('users','userid')), 
	currval(pg_get_serial_sequence('sessions','sessionid')), 
	(select speakerid FROM speakers WHERE speakername = 'President Nelson'),
	'The name of the church must include Jesus'
);

select notes.note,sess.day,speaker.speakername FROM notes JOIN sessions sess ON notes.sessionid = sess.sessionid JOIN speakers speaker ON notes.speakerid = speaker.speakerid;

