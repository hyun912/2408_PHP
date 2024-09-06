/*
	스토어드 프로시저(Stored Procedure)
		ㄴ쿼리들을 모아 하나의 함수로 실행
		ㄴ네트워크 부하가 감소되어 처리시간감소
		ㄴ유지보수가 매우 힘듬
		ㄴphp와 db측의 이중관리 필요
		ㄴ그래서 하는기업은하고 안하는기업은 안함
*/

/* 생성, 완벽이 맞아야함 (공백, $$등) */
DELIMITER $$

CREATE PROCEDURE add_emp(
	IN param_name VARCHAR(50)
	,IN param_birth VARCHAR(10)
	,IN param_gender CHAR(1)
)

BEGIN

	/* 변수선언 */
	DECLARE cup BIGINT(20) DEFAULT 0; -- default 필수아님
	
	INSERT INTO employees (
		NAME
		,birth
		,gender
		,hire_at
	)
	VALUES(
		param_name
		,param_birth
		,param_gender
		,DATE(NOW())
	);
	
	SELECT emp_id
	INTO cup -- ↖변수담음
	FROM employees
	ORDER BY emp_id desc
	LIMIT 1
	;
	
	
	INSERT INTO salaries (
		emp_id
		,salary
		,start_at
	)
	VALUES(
		cup
		,25000000
		,DATE(NOW())
	);
	
END $$

DELIMITER
;


/* 실행 */
CALL add_emp('느아앙', '2000-01-01', 'M');

/* 삭제 */
DROP PROCEDURE add_emp;