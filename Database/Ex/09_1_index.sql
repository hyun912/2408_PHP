/* 최후의 방법이지 쿼리빌드가 너무오래걸려서 어쩔수없을때나 사용함 */
/* index 확인 */
SHOW INDEX 
FROM employees
;


/* 유무차이가 쿼리시간 줄어듬 */
SELECT * 
FROM employees 
WHERE 
	NAME = '주정웅'
;


/* index 생성 */
ALTER TABLE employees 
	ADD INDEX idx_employees_name (name)
;


/* index 제거 */
DROP INDEX idx_employees_name 
	ON employees
;