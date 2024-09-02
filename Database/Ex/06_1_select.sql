/*
	SELECT : 데이터 조회
	
	select 컬럼명, 컬럼명 from 테이블명;
	* = Asterisk|에스터리스크
*/ 

SELECT 
	emp_id
	,name 
FROM employees
;

SELECT *
FROM employees
;

SELECT *
FROM titles
;

SELECT 
	title_code
	,emp_id
FROM title_emps

/*
	where : 조건 조회
*/

SELECT * 
FROM employees
WHERE 
	emp_id = 10000
;

SELECT *
FROM employees
WHERE
	NAME = '원성현'
;


/* 비교연산자 : >, <, =, >= , <=, != */

SELECT * 
FROM employees
WHERE 
	emp_id != 6
;

SELECT *
FROM employees
WHERE 
	birth >= '1990-01-01' -- or 19900101 (mariaDB)
;


/* and(~고), or(~나) */

SELECT *
FROM employees
WHERE 
		birtch >= '1990-01-01' 
	AND 
		gender = 'M'
;

SELECT *
FROM employees
WHERE
		NAME= '원성현'
	OR 
		NAME= '반승현'
;

SELECT *
FROM employees
WHERE
	(	
			NAME = '원성현'
		AND
			birth >= '1990-01-01'
	)
	OR
		NAME = '반승현'
;

SELECT 
	emp_id
	,title_code 
FROM title_emps
WHERE 
	(
			title_code = 'T001'
		OR 
			title_code = 'T002'
	)
	AND 
		start_at >= '2000-01-01'
;

SELECT *
FROM employees
WHERE
		birth >= '2000-01-01'
	AND
		birth <= '2001-01-01'
;


/* in : 지정값과 일치값 조회 */

SELECT *
FROM employees
WHERE
	NAME IN (
		'염문창'
		,'지도연'
		,'안소정'
	)
; 


/* beteew : 지정범위 데이터 조회 */

SELECT * 
FROM employees
WHERE
	birth BETWEEN 
			'2000-01-01'
		AND
			'2001-01-01'
;


/* 
	like : 문자열 조회 (대소문자 구분X)
		% - 글자수 상관없이 조회
			ㄴ%글 - 로 끝나는 단어들
			ㄴ%글% - 중간 포함 단어들
		
		_ - 언더바 개수만큼 검색
			ㄴ나머진 위와 같음
*/

SELECT *
FROM employees
WHERE
		NAME LIKE '염%'
	AND
		NAME LIKE '염__'
;


/* 
	order by : 데이터 정렬, 여러개는 콤마로 구분
		ㄴasc - 오름차순, 생략가능하지만 적는게 좋음
		ㄴdesc - 내림차순
*/

SELECT *
FROM employees
WHERE 
		gender = 'F'
	ORDER BY 
		NAME ASC
		,birth DESC
;


/* distinct : 검색결과에서 중복레코드 제외, 잘안씀 */

SELECT DISTINCT 
	emp_id
	,title_code
FROM title_emps
;


/*
	group by : 묶어서 조회
	having : ↖의 조건절
		ㄴ표준문법준수 - SELECT 절에 작성하는 컬럼은 GROUP BY 절에서 
								사용한 같은 컬럼과 집계 함수(sum, max, min, avg, count)만 작성
*/

SELECT 
	emp_id
	,MAX(salary)
FROM salaries
	GROUP BY emp_id
		HAVING 
			MAX(salary) >= 50000000
;


/* is null, is not null : null값 전용 */

SELECT *
FROM department_emps
WHERE
	end_at IS NOT NULL
;


/* as : 컬럼 or 테이블에 별칭부여*/
-- 부서별 소속 사원수
SELECT 
	dept_code
	,COUNT(*) AS cnt
FROM department_emps
WHERE 
	end_at IS NULL
GROUP BY dept_code
;
		
