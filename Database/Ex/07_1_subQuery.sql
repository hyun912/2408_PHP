
/* 이런게있다~, join 쓰는게 편함 */
/* where 서브쿼리 */

SELECT
	employees.emp_id
	,employees.name
FROM employees
WHERE
	employees.emp_id IN (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE
				department_managers.end_at IS NULL
	)
;

SELECT 
	employees.emp_id
	,employees.name
	,employees.birth
FROM employees
WHERE
	employees.emp_id IN (
		SELECT title_emps.emp_id
		FROM title_emps
		WHERE
				title_emps.title_code = 'T006'
			AND
				title_emps.end_at IS NULL
	)
;

SELECT
	department_emps.*
FROM department_emps
WHERE
	(department_emps.emp_id, department_emps.dept_code) IN (
		SELECT
			department_managers.emp_id
			,department_managers.dept_code
		FROM department_managers
		WHERE
				department_managers.end_at IS NULL
			AND
				department_managers.dept_code = 'D002'

	)
;


/* 연관 서브쿼리 */

SELECT
	employees.*
FROM employees
WHERE
	employees.emp_id IN (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE
			department_managers.emp_id = employees.emp_id
	)
;


/* select 서브쿼리 */

SELECT
	employees.emp_id
	,employees.name
	,(
		SELECT AVG(salaries.salary)
		FROM salaries
		WHERE
			employees.emp_id = salaries.emp_id
	) AS avg_sal
FROM employees
;


/* from 서브쿼리 */

SELECT
	tmp.*
FROM (
	SELECT
		employees.emp_id
		,employees.name
	FROM employees	
) AS tmp
;


/* insert 서브쿼리 */

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
	(SELECT emp.NAME FROM employees AS emp WHERE emp.emp_id = 1000)
	,'2000-01-01'
	,'M'
	,DATE(NOW())
	,NULL
	,NULL
	,NOW()
	,NOW()
	,NULL
)
;


/* update 서브쿼리 */

UPDATE employees
SET
	employees.gender = (
		SELECT 
			emp.gender
		FROM employees AS emp
		where
			emp.emp_id = 100000
	)
WHERE
	employees.emp_id = (
		SELECT 
			MAX(emp2.emp_id)
		FROM employees emp2
	)
;