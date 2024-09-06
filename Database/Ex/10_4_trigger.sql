/* 트리거, 이것도 이중관리 문제있음 */

/* 생성 */
DELIMITER $$

CREATE TRIGGER del_emp
BEFORE DELETE ON employees -- delete employees 실행할때 아래의 트리거 발동
FOR EACH ROW
BEGIN

	DELETE FROM department_emps WHERE emp_id = OLD.emp_id;
	DELETE FROM department_managers WHERE emp_id = OLD.emp_id;
	DELETE FROM salaries WHERE emp_id = OLD.emp_id;
	DELETE FROM title_emps WHERE emp_id = OLD.emp_id;
	
END $$

DELIMITER
;

DELETE FROM employees WHERE emp_id = 1;

/* 조회 */
SHOW TRIGGERS;

/* 삭제 */
DROP TRIGGER del_emp;