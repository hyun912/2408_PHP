
-- 1. 사원의 사원번호, 이름, 직급코드를 출력해 주세요.

SELECT
	employees.emp_id
	,employees.name
	,title_emps.title_code
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
;


-- 2. 사원의 사원번호, 성별, 현재 연봉을 출력해 주세요.

SELECT DISTINCT
	employees.emp_id
	,employees.gender
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
;



-- 3. 10010 사원의 이름과 과거부터 현재까지 연봉 이력을 출력해 주세요.

SELECT
	employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.emp_id = 10010
ORDER BY salaries.start_at ASC
;


-- 4. 사원의 사원번호, 이름, 소속부서명을 출력해 주세요.

SELECT
	employees.emp_id
	,employees.name
	,departments.dept_name
FROM employees
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
;


-- 5. 현재 연봉의 상위 10위까지 사원의 사번, 이름, 연봉을 출력해 주세요.

SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
ORDER BY salaries.salary DESC
LIMIT 10
;


-- 6. 현재 각 부서의 부서장의 부서명, 이름, 입사일을 출력해 주세요.

SELECT
	departments.dept_name
	,employees.name
	,employees.hire_at
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
			AND department_managers.end_at IS NULL
	JOIN departments
		ON department_managers.dept_code = departments.dept_code
;


-- 7. 현재 직급이 "부장"인 사원들의 연봉 평균을 출력해 주세요.

SELECT
	AVG(salaries.salary) AS avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
			AND titles.title = '부장' 
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
WHERE 
	title_emps.end_at IS NULL
GROUP BY title_emps.emp_id
;

-- 8. 부서장직을 역임했던 모든 사원의 이름과 입사일, 사번, 부서번호를 출력해 주세요.

SELECT
	employees.name
	,employees.hire_at
	,employees.emp_id
	,department_managers.dept_code
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
;


-- 9. 현재 각 직급별 평균연봉 중 60,000,000이상인 직급의 직급명, 평균연봉(정수)를을 내림차순으로 출력해 주세요.

SELECT
	titles.title
	,CEILING(AVG(salaries.salary)) AS avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
WHERE
	title_emps.end_at IS NULL
GROUP BY titles.title
	HAVING avg_sal >= 60000000
ORDER BY avg_sal DESC
;


-- 10. 성별이 여자인 사원들의 직급별 사원수를 출력해 주세요.

SELECT
	titles.title
	,COUNT(*) AS cnt
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
	JOIN titles
		ON title_emps.title_code = titles.title_code
WHERE
	employees.gender = 'F'
GROUP BY titles.title
;

