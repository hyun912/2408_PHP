-- 1. 직급테이블의 모든 정보를 조회해주세요.
SELECT *
FROM titles
;


-- 2. 급여가 60,000,000 이하인 사원의 사번을 조회해 주세요.

SELECT DISTINCT
	salaries.emp_id
FROM salaries
WHERE
		salaries.salary <= 60000000
	AND
		salaries.end_at IS NULL
;


-- 3. 급여가 60,000,000에서 70,000,000인 사원의 사번을 조회해 주세요.

SELECT DISTINCT
	salaries.emp_id
FROM salaries
WHERE
		salaries.end_at IS NULL
	AND
		salaries.salary BETWEEN
				60000000
			AND
				70000000
;


-- 4. 사원번호가 10001, 10005인 사원의 사원테이블의 모든 정보를 조회해 주세요.

SELECT *
FROM employees
WHERE
	employees.emp_id IN (10001, 10005)
;


-- 5. 직급명에 '사'가 포함된 사원의 직급코드와 직급명을 조회해 주세요.

SELECT 
	titles.title_code
	,titles.title
FROM titles
WHERE
	titles.title LIKE '%사%'
;


-- 6. 사원의 이름을 오름차순으로 정렬해서 조회해 주세요.

SELECT employees.name
FROM employees
ORDER BY employees.name ASC
;

-- 7. 사원별 전체 급여의 평균을 조회해 주세요.

SELECT
	salaries.emp_id
	,AVG(salaries.salary) AS avg_sal
FROM salaries
GROUP BY salaries.emp_id
;


-- 8. 사원별 전체 급여의 평균이 30,000,000 ~ 50,000,000인, 사원번호와 평균급여를 조회해 주세요.

SELECT
	salaries.emp_id
	,AVG(salaries.salary) AS avg_sal
FROM salaries
GROUP BY salaries.emp_id
	HAVING avg_sal BETWEEN 
			30000000 
		AND 
			70000000
;


-- 9. 사원별 전체 급여 평균이 70,000,000이상인, 사원의 사번, 이름, 성별을 조회해 주세요.

SELECT 
	employees.emp_id
	,employees.name
	,employees.gender
FROM employees
WHERE
	employees.emp_id IN (
		SELECT salaries.emp_id
		FROM salaries
		GROUP BY salaries.emp_id
			HAVING
				AVG(salaries.salary) >= 70000000
	)
;


-- 10. 현재 직급이 'T005'인, 사원의 사원번호와 이름을 조회해 주세요.

SELECT 
	employees.emp_id
	,employees.name
FROM employees
WHERE
	employees.emp_id IN (
		SELECT 
			title_emps.emp_id
		FROM title_emps
		WHERE
				title_emps.title_code = 'T005'
			AND
				title_emps.end_at IS NULL
	)
;