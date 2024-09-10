
/* 타입 변환 */

SELECT 
	1234
	,CAST(1234 AS CHAR(4))
	,CONVERT(1234, CHAR(4)) -- 이걸 주로씀
;


/* 
	-**제어흐름 
	if : (값, true, else) as 명칭
	ifnull (null아닐시, null일시) as 명칭, 보통 밑에거보다 이걸씀
	nullif (거짓이면 여길 반환, 왼쪽과 비교헤서 참이면 null) as 명칭
*/

SELECT
	emp_id
	
	,gender
	,IF(gender = 'M', '남자', '여자') AS ko_gender
	,NULLIF(gender, 'F') AS gender_F
	
	,fire_at
	,IFNULL(fire_at, '9999-01-01') fire_at_not_null
FROM employees
;

/* **case : switch */

SELECT 
	emp_id
	,CASE gender
		WHEN 'M' THEN '남자'
		WHEN 'F' THEN '여자'
		ELSE '몰?루'
	END AS ko_gender
FROM employees
;

SELECT 
	emp_id
	,salary
	,CASE
		WHEN salary <= 30000000 THEN '평범'
		ELSE '많다'
	END AS 'wayge'
FROM salaries
;


/* 
	-문자열 함수, 프흐프에서 쓰지 여기선 크게 쓰이진 않음
		ㄴconcat : 문자열 연결
		ㄴconcat_ws : 첫번째에 구분자를 중간중간 삽입헤서 연결, 마지막은 안들어감
		ㄴformat : (숫자, 소수점자리수), 자동 쉼표
		ㄴleft : 문자열 '왼쪽'부터 숫자길이만큼 자름
		ㄴright : 문자열 '오른쪽'부터 숫자길이만큼 자름
		ㄴupper : 소->대문자
		ㄴlower : 대->소문자
*/
SELECT 
	CONCAT('하용', ' ', '디비임당')
	,CONCAT_WS(', ', '딸기', '바나나', '수박', '자두')
	,FORMAT(50000, 0)
	,LEFT('abcde', 2)
	,RIGHT('abcde', 2)
	,UPPER('abcde')
	,LOWER('ABCDE')
;


/*
	**그나마 쓰인다고함
	lpad : 문자열포함 길이만큼 '왼쪽'에 삽입
	rpad : 문자열포함 길이만큼 '오른쪽'에 삽입
	trim : 좌우공백제거, 중간 공백은 못없앰
			아래 옵션은 잘안쓰고 보통이것만 씀
		ㄴ방향 :  both(좌우), leading(좌), trailing(우)
		ㄴltrim : 좌측만제거
		ㄴrtrim : 우측만제거
	substring : 시작위치에서 길이만큼 자름
	substring_index : 구분자가 횟수만큼 나오면 자르고 나머진 버림
*/

SELECT
	LPAD('321', 5, '0')
	,RPAD('321', 5, '0')
	,TRIM('   갓 갓   ')
	,TRIM(BOTH 'ab' FROM 'abcabcab')
	,SUBSTRING('abcdef', 3, 2)
	,SUBSTRING_INDEX('가_나_다', '_', -1)
;


/*
	-수학관련, 안씀
		ㄴceiling : 올림
		ㄴfloor : 버림
		ㄴround : 반올림
		ㄴtruncate : 소수점기준 위치값까지 구하고 나머지 버림
*/

SELECT 
	CEILING(1.2)
	,FLOOR(1.9)
	,ROUND(1.5)
	,TRUNCATE(1.2345, 2)
;


/* 
	-**날짜시간, 많이쓰임
		ㄴnow() : 현재 날짜
		ㄴdate(값) : yyyy-mm-dd로 변환
		ㄴ**adddate(date1, interval date2) : date1의 data2전후값을 가져옴
					ㄴ year, month, week, day, hour, minute, second
*/

SELECT 
	now()
	,DATE(NOW())
	,ADDDATE('2024-01-01', INTERVAL 1 YEAR)
	,ADDDATE('2024-01-01', INTERVAL -1 YEAR)
;


/* 집계 */

SELECT 
	SUM(salary)
	,MAX(salary)
	,MIN(salary)
	,AVG(salary)
;

SELECT 
	COUNT(fire_at) -- null아닌 레코드만, 단일만됨
	,COUNT(*) -- 싹다
FROM employees
;


/* 순위 */

SELECT
	emp_id
	,salary
	,RANK() OVER(ORDER BY salary DESC) AS sal_rank
	,ROW_NUMBER() OVER(ORDER BY salary DESC) AS sal_rank2
FROM salaries
LIMIT 5;