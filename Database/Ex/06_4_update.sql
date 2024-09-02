
/* update : 기존 레코드 수정, set전에 where먼저 작성하는게 좋음 */
  
UPDATE employees
SET 
	gender = 'M'
	,updated_at = NOW()
WHERE emp_id = 100002
;




UPDATE title_emps
SET
	title_code = 'T005'
WHERE 
		emp_id = 100002
	AND
		end_at IS NULL
;

UPDATE salaries
SET
	salary = 50000000
	,updated_at = NOW()
WHERE 
		salary <= 26000000
	AND
		end_at IS NULL
;

SELECT * 
FROM salaries
WHERE 
		salary = 50000000
	AND
		end_at IS NULL
;

