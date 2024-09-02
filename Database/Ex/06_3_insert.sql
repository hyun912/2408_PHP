
/* 
	insert : 레코드 데이터 하나 생성, 
		하나 이상할시 values()뒤에 콤마로 여러개 가능 
*/

INSERT INTO employees (
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	'김현석'
	,'2000-01-01'
	,'M'
	,'2024-09-02'
	,NULL
	,NULL
	,NOW()
	,'2024-09-02 00:00:00'
	,NULL
)
,('김현석','2000-01-01','M','2024-09-02',NULL,NULL,NOW(),'2024-09-02 00:00:00',NULL)
,('김현석','2000-01-01','M','2024-09-02',NULL,NULL,NOW(),'2024-09-02 00:00:00',NULL)
,('김현석','2000-01-01','M','2024-09-02',NULL,NULL,NOW(),'2024-09-02 00:00:00',NULL)
;


/* insert select : 조건에 맞는 데이터를 복붙 */

INSERT INTO employees (
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
SELECT 
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
FROM employees
WHERE emp_id IN (1,2)
;






/* 나의 직급, 급여, 부서 생성 */

INSERT INTO title_emps (
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,'T008'
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
)
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,31096511
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
)
;

INSERT INTO department_emps (
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,'D001'
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
)
;