
/* delete : 레코드 삭제, 이것도 where먼저 작성  */

DELETE 
FROM salaries
WHERE emp_id = 100002 
;

SELECT *
FROM salaries
WHERE emp_id = 100002
;


DELETE 
FROM title_emps
WHERE emp_id = 100002 
;

SELECT *
FROM title_emps
WHERE emp_id = 100002
;

/*
	-숫자 데이터
		ㄴint : 4byte 정수, 범위 약 +21억 ~ -21억
		ㄴbigint : 8byte 정수, 범위 약 +900경 ~ - 900경
		
	-문자열
		ㄴchar : 1~255byte, n만큼 '고정'길이, 성별같이 고정값, 밑에거보다 빠름
		ㄴvarchar : 1~65535byte, n만큼 가변길이, 제목같이 수시로 변하는내용
		ㄴlongtext : 최대 약 4Gb text 데이터값 저장, varchar로 커버안될때 사용
		
	-날짜
		ㄴdate : 3byte, yyyy-mm-dd
		ㄴdatetime : 8byte, yyyy-mm-dd hh:mi:ss, '고정'타입
		ㄴdatestamp : 4byte, yyyy-mm-dd hh:mi:ss, '유동'타입
							1970-01-01 00:00:01에서 얼마나 지났는지 유닉스 타임으로 저장
							
	-논리
		ㄴboolean : 1byte, 1(true) or 0(false), tinyint(1)와 같음
*/
