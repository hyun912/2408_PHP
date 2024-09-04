
/* 
	join : 두개 이상의 테이블을 묶어서 하나의 교집합 출력
		ㄴinner join : 테이블들의 교집합, inner 생략가능, **가장 많이쓰임
		ㄴleft outer : 좌측 테이블 전부 + 교집합, 없는건 null표시
		ㄴself join
	나머진 안씀
*/

SELECT
	employees.emp_id
	,employees.name
	,department_emps.dept_code
	,departments.dept_name
FROM employees
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
		AND department_emps.end_at IS NULL
	JOIN departments
		ON department_emps.dept_code = department_emps.dept_code
WHERE
	departments.end_at IS NULL
;

SELECT
	employees.emp_id
	,employees.name
	,department_managers.start_at
FROM employees
	LEFT JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
WHERE
	department_managers.end_at IS NULL
ORDER BY department_managers.start_at DESC
;

SELECT
	emp1.emp_id
	,emp1.name
FROM employees AS emp1
	JOIN employees AS emp2
		ON emp1.emp_id = emp2.sup_id
;


-- 우측 + 교집합
SELECT 
	employees.emp_id
	,employees.name
	,department_managers.start_at
FROM department_managers
	RIGHT JOIN employees
		ON department_managers.emp_id = employees.emp_id
WHERE
	department_managers.end_at IS NULL
ORDER BY department_managers.start_at DESC
;

-- 양쪽 모두 합침, all 넣을시 중복제거 안함
SELECT * FROM employees WHERE emp_id IN(1,3)
UNION ALL
SELECT * FROM employees WHERE emp_id IN(3,6)
;
