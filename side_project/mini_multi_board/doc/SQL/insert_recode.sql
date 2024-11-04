-- 게시판 카테고리 정보 추가
INSERT INTO boards_category(
	bc_type
	,bc_name
)VALUES
('0', '자유게시판')
,('1', '질문게시판');

-- 테스트용 유저
INSERT INTO users(
	u_email
	,u_name
	,u_password
)VALUES
('admin@admin.com', '관리자', 'cXdlMTIz');

-- 테스트용 게시글
INSERT INTO boards(
	u_id
	,bc_type
	,b_title
	,b_content
	,b_img
)VALUES
(1, '0', '자유1', '내용1', '/View/img/001.png')
,(1, '0', '자유2', '내용2', '/View/img/002.png')
,(1, '0', '자유3', '내용3', '/View/img/003.png')
,(1, '1', '질문1', '내용4', '/View/img/004.png')
,(1, '1', '질문2', '내용5', '/View/img/005.png');

ALTER TABLE boards	
	MODIFY COLUMN bc_type	CHAR(1) NOT NULL
;