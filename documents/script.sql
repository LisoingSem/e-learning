// Update Note 
update users set users.role_id=users.user_roll_id
INSERT roles(roles.id,roles.`name`,roles.name_kh) select id, en, kh from user_rolls where user_rolls.id > 1 ORDER BY user_rolls.id
update r_staffs INNER JOIN employees on r_staffs.employee_id=employees.id set r_staffs.organization_id = employees.organization_id
update organizations set is_use_request = 1 where id in (1, 10, 39)
update r_requests set to_organization_id=1

update r_requests INNER JOIN users on r_requests.created_by=users.id set r_requests.validator_id=users.employee_id 
where r_requests.level_status = 1

