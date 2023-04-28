DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS users;


CREATE TABLE users(
    id SERIAL PRIMARY KEY,
    pseudo VARCHAR UNIQUE NOT NULL,
    password VARCHAR UNIQUE NOT NULL
);


CREATE TABLE contacts(
    id SERIAL PRIMARY KEY,
    lastname VARCHAR,
    firstname VARCHAR,
    email VARCHAR UNIQUE NOT NULL,
    phone VARCHAR,
    birthdate VARCHAR,
    picture_path VARCHAR,
    id_user VARCHAR NOT NULL,
    FOREIGN KEY(id_user) REFERENCES users(id)
);