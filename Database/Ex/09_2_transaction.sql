/* transaction
	ㄴ완전히 적용되는지 완전히 다중체크
	ㄴ데이터 전용이라 테이블관련엔 못씀
	ㄴ이력(log)을 남기기위해 사용 
*/

/* 가상빌드 스타트 */
START TRANSACTION;

INSERT INTO employees (
	NAME, birth, gender, hire_at
)
VALUES (
	'느어어', '2000-01-01', 'M', DATE(NOW())
);

SELECT * FROM employees WHERE emp_id >= 100001;

/* 아닌것같으면 되돌림 */
ROLLBACK;

/* 실제 DB에 반영시킴 */
COMMIT;
