
CREATE DATABASE mini_multi_board;

USE mini_multi_board;

DROP DATABASE if EXISTS mini_multi_board;

DROP TABLE if EXISTS users;
DROP TABLE if EXISTS boards;
DROP TABLE if EXISTS boards_category;

SET foreign_key_checks = 0;

-- user = pk, 이메일, 비밀번호, 이름
CREATE TABLE users(
	u_id					BIGINT UNSIGNED 		PRIMARY KEY AUTO_INCREMENT
	,u_email				VARCHAR(100)	 		NOT NULL
	,u_password    	VARCHAR(256) BINARY	NOT NULL
	,u_name 				VARCHAR(50)				NOT NULL
	,created_at			TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at			TIMESTAMP				NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at			TIMESTAMP				NULL
);


-- boards = pk, 유저pk, 게시판타입, 제목, 내용, 이미지파일
CREATE TABLE boards(
	b_id					BIGINT UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,u_id					BIGINT UNSIGNED 	NOT NULL
	,bc_type				CHAR(1)				NOT NULL
	,b_title				VARCHAR(50)			NOT NULL
	,b_content			VARCHAR(200)		NOT NULL
	,b_img				VARCHAR(100)		NOT NULL
	,created_at			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at			TIMESTAMP			NULL
);


-- boards_category = pk, 게시판타입, 게시판이름
CREATE TABLE boards_category(
	bc_id					BIGINT UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,bc_type				CHAR(1)				NOT NULL UNIQUE
	,bc_name 			VARCHAR(20)			NOT NULL
	,created_at			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at			TIMESTAMP			NULL
);

-- 관리 용이를 위해 생성뒤에 알터로 제약조건 추가
ALTER TABLE boards ADD 
CONSTRAINT fk_boards_user_id
FOREIGN KEY (u_id) 
REFERENCES users (u_id);

ALTER TABLE boards ADD
CONSTRAINT fk_boards_boards_category_id
FOREIGN KEY (bc_type)
REFERENCES boards_category (bc_type);