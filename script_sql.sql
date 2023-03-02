SELECT * , stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight*cal_plo.plo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,calculate_plo cal_plo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
    cal_plo.plo_id = cal_cou.plo_id AND
    cal_plo.course_id =cal_cou.course_id



SELECT * , stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id 



SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id 


    CREATE VIEW plo_program AS 
SELECT stu.student_sub_assign_score_id ,stu.score , stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.weight,clo.clo_id , clo.assign_id , cal_pro.calculate_proport_id, cal_pro.proport_weight , cal_sub.calculate_sub_assign_id , cal_sub.sub_assign_weight , cal_assign.calculate_assign_id , cal_assign.assign_weight , cal_cou.calculate_plo_course_id , cal_cou.plo_clo_weight , cal_cou.plo_id, cal_plo.calculate_plo_id , cal_plo.plo_weight ,stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight*cal_plo.plo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,calculate_plo cal_plo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
    cal_plo.plo_id = cal_cou.plo_id AND
    cal_plo.course_id =cal_cou.course_id;


    CREATE VIEW plo_course AS 
SELECT stu.student_sub_assign_score_id ,stu.score , stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.weight,clo.clo_id , clo.assign_id , cal_pro.calculate_proport_id, cal_pro.proport_weight , cal_sub.calculate_sub_assign_id , cal_sub.sub_assign_weight , cal_assign.calculate_assign_id , cal_assign.assign_weight , cal_cou.calculate_plo_course_id , cal_cou.plo_clo_weight , cal_cou.plo_id ,stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,calculate_plo cal_plo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
    cal_plo.plo_id = cal_cou.plo_id AND
    cal_plo.course_id =cal_cou.course_id;


CREATE VIEW clo_course AS 
SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight ,stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id ;


SELECT DISTINCT course_id , clo_id ,student_id ,
    MIN(ary_score) over (PARTITION BY clo_id) as min_clo ,
    MAX(ary_score) over (PARTITION BY clo_id) as max_clo ,
    AVG(ary_score) over (PARTITION BY clo_id) as avg_clo 
FROM
(SELECT *,sum(proport_score) AS ary_score
FROM
( SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , cou_clo.course_id , stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,course_clo cou_clo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
	cou_clo.course_id = '305282'
) 
 AS clo_tb GROUP BY student_id,clo_id) AS sum_clo


 SELECT student_id ,plo_id ,clo_id , proport_score,sum(proport_score) AS ary_score
FROM
( SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , cou_clo.course_id , cal_cou.calculate_plo_course_id , cal_cou.plo_clo_weight , cal_cou.plo_id, stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,course_clo cou_clo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
	cou_clo.course_id = '305282'
) 
 AS clo_tb GROUP BY student_id,clo_id,plo_id


SELECT DISTINCT course_id , clo_id ,plo_code,plo_id,
MIN(proport_score) over (PARTITION BY clo_id) as min_clo ,
MAX(proport_score) over (PARTITION BY clo_id) as max_clo ,
AVG(proport_score) over (PARTITION BY clo_id) as avg_clo 
FROM(
SELECT student_id  ,clo_id ,course_id, proport_score,sub_assign_id,sum(proport_score) over (PARTITION BY clo_id,student_id) AS ary_score
FROM
( SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , cou_clo.course_id , cal_cou.calculate_plo_course_id , cal_cou.plo_clo_weight , cal_cou.plo_id,plo.plo_code, stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,course_clo cou_clo,plo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
clo.clo_assign_id = stu.clo_assign_id AND 
clo.clo_id = cal_pro.clo_id AND
cal_sub.assign_id = cal_pro.assign_id AND
cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
cal_assign.assign_id = cal_sub.assign_id AND
cal_cou.course_id = cal_assign.course_id AND
 cal_cou.plo_id = plo.plo_id AND
cou_clo.course_id = '305282'
) 
AS clo_tb GROUP BY student_id,clo_id,sub_assign_id
) AS sum_clo 



SELECT DISTINCT course_id ,plo_code,plo_id,
MIN(ary_score)  as min_clo ,
MAX(ary_score)  as max_clo ,
AVG(ary_score)  as avg_clo 
FROM(
SELECT DISTINCT student_id  ,clo_id ,plo_id,plo_code,course_id, sum(proport_score) over (PARTITION BY clo_id,student_id) AS ary_score
FROM
( SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , cou_clo.course_id , cal_cou.calculate_plo_course_id , cal_cou.plo_clo_weight , cal_cou.plo_id,plo.plo_code, stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight*cal_cou.plo_clo_weight*cal_plo.plo_weight as proport_score
FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,calculate_plo_course cal_cou,calculate_plo cal_plo,course_clo cou_clo,plo,plo_clo
WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cal_cou.course_id = cal_assign.course_id AND
    cal_plo.plo_id = cal_cou.plo_id AND
    cal_plo.course_id =cal_cou.course_id AND
 clo.clo_id = plo_clo.clo_id AND
 cal_cou.plo_id = plo_clo.plo_id AND
cou_clo.course_id = '305282'
) 
AS clo_tb GROUP BY student_id,clo_id,sub_assign_id
) AS sum_clo GROUP BY plo_id