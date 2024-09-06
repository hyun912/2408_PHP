/* 
	view : 보안권한주기 
		ㄴ한번정의하면 변경불가
		ㄴ이거쓰면 index 못씀
		
	인덱스를 못쓰게되서 잘안씀
*/

/* 생성 */
CREATE VIEW view_emp_now_data
AS

-- 사번, 이름, 직급명, 부서명, 연봉 조회
SELECT
	employees.emp_id
	,employees.name
	,tit.title
	,dep.dept_name
	,sal.salary
FROM employees
	JOIN (
			SELECT 
				salaries.emp_id
				,salaries.salary
			FROM salaries
			WHERE salaries.end_at IS NULL
		) AS sal
		ON employees.emp_id = sal.emp_id
	JOIN (
		SELECT 
			title_emps.emp_id
			,titles.title
		FROM title_emps
			JOIN titles
				ON title_emps.title_code = titles.title_code
				AND title_emps.end_at IS NULL
	)AS tit
		ON employees.emp_id = tit.emp_id
	JOIN (
		SELECT
			department_emps.emp_id
			,departments.dept_name
		FROM department_emps
			JOIN departments
				ON department_emps.dept_code = departments.dept_code
				AND department_emps.end_at IS NULL
	)AS dep
		ON employees.emp_id = dep.emp_id
ORDER BY employees.emp_id ASC
;

/* 사용 */
SELECT * FROM view_emp_now_data;

/* 삭제 */
DROP VIEW view_emp_now_data;