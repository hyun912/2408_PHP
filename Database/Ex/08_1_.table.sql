/* db 생성 */
CREATE DATABASE shop;

/* db 선택 */
USE shop;
USE dbsample;

/* db 삭제 */
DROP DATABASE shop;


/* 테이블 생성 */
CREATE TABLE users (
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT
	,name VARCHAR(50) NOT NULL
	,addr VARCHAR(150) NOT NULL
	,gender CHAR(1) NOT NULL COMMENT 'M = 남자, F = 여자'
	,tel VARCHAR(20) NOT NULL COMMENT '하이픈(-) 제외 숫자'
	,created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP NULL
);

CREATE TABLE orders (
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT
	,user_id BIGINT(20) NOT NULL
	,order_id VARCHAR(50) NOT NULL
	,total_price BIGINT(20) NOT NULL
	,created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP NULL
);

CREATE TABLE products (
	id BIGINT(20) PRIMARY KEY AUTO_INCREMENT
	,product_name VARCHAR(100) NOT NULL
	,price BIGINT(20) NOT NULL
	,created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP NULL
	
);


/* 
	테이블 수정
	ALTER TABLE [테이블명] ADD 
	CONSTRAINT [Constraint명] 
	FOREIGN KEY (Constraint 부여 컬럼명) 
	REFERENCES 참조테이블명(참조테이블 컬럼명) 
	[ON DELETE 동작 / ON UPDATE 동작]; 
*/
ALTER TABLE orders ADD 
	CONSTRAINT fk_orders_user_id 
	FOREIGN KEY (user_id) 
	REFERENCES users (id)
;

/* 테이블 삭제 */
DROP TABLE orders;
DROP TABLE users, products;

/* 테이블 비우기 */
TRUNCATE users;


/* 컬럼 추가 */
ALTER TABLE users
ADD COLUMN addr VARCHAR(100) NOT NULL
;	
	
/* 컬럼 수정 */
ALTER TABLE users
	MODIFY COLUMN addr VARCHAR(150) NOT NULL
;

/* 컬럼 삭제 */
ALTER TABLE users
	DROP COLUMN birth
;



/* fk 연결 끊고 부호없음 적용 */
ALTER TABLE orders
	DROP CONSTRAINT fk_orders_user_id
;

ALTER TABLE users
	MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT
;

ALTER TABLE orders
	MODIFY COLUMN user_id BIGINT(20) UNSIGNED NOT NULL
;

ALTER TABLE orders ADD 
	CONSTRAINT fk_orders_user_id 
	FOREIGN KEY (user_id) 
	REFERENCES users (id)
;

ALTER TABLE orders
	MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT
;

ALTER TABLE products
	MODIFY COLUMN id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT
;