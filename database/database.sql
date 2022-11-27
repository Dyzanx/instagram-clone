CREATE DATABASE IF NOT EXISTS instragram-clone-db;
USE instragram-clone-db;

CREATE TABLE IF NOT EXISTS users(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    role varchar(20),
    name varchar(100) not null,
    surname varchar(200) not null,
    nickname varchar(100) not null,
    email varchar(255) not null unique,
    password varchar(255) not null,
    image TEXT,
    remember_token varchar(255),
    created_at datetime,
    updated_at datetime
)Engine=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'app', 'admin', 'GOD', 'admin@prueba.com', '12345678', NULL, NULL, CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS posts(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    user_id int(255) not null,
    image_path TEXT,
    description varchar(255),
    created_at datetime,
    updated_at datetime,

    CONSTRAINT fk_posts_users FOREIGN KEY (user_id) REFERENCES users(id)
)Engine=InnoDb;

INSERT INTO posts VALUES(NULL, 1, '', 'EXAMPLE INSERT FROM databalse.sql FILE', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    user_id int(255) not null,
    post_id int(255) not null,
    content TEXT,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_posts FOREIGN KEY (post_id) REFERENCES posts(id)
)Engine=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 1, 'thath car so crazy!', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    user_id int(255) not null,
    post_id int(255) not null,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_posts FOREIGN KEY (post_id) REFERENCES posts(id)
)Engine=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 1, CURTIME(), CURTIME());