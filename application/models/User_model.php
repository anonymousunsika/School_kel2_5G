<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUserData($email)
    {
        $query = "SELECT `user`.*, `classroom_users`.`classroom_id`,
        `classroom_users`.`time_group`, 
        `classroom`.`name` AS kelas, `classroom`.`semester` AS semesterkelas, 
        `classroom`.`prodi_id` AS classroom_prodi,`prodi`.`name` AS jurusan
        FROM `user` LEFT JOIN `prodi` ON `user`.`prodi_id` = `prodi`.`id`
        LEFT JOIN `classroom_users`
        ON `user`.`id` = `classroom_users`.`user_id`
        LEFT JOIN `classroom`
        ON `classroom_users`.`classroom_id` = `classroom`.`id`
        WHERE `user`.`email` = " . $email;

        return $this->db->query($query)->row_array();
    }

    public function getClassroomUser($userId)
    {
        $query = "SELECT `classroom`.*, `prodi`.`name` AS prodi,
        `classroom_users`.`accepted`, `classroom_users`.`date_accepted`,
        `classroom_users`.`time_group`
        FROM `classroom_users` 
        LEFT JOIN `classroom` ON `classroom`.`id` = `classroom_users`.`classroom_id`
        LEFT JOIN `prodi` ON `prodi`.`id` = `classroom`.`prodi_id`
        WHERE `classroom_users`.`user_id` = " . $userId;
        return $this->db->query($query)->result_array();
    }

    public function getClassroom($classId)
    {
        $query = "SELECT `classroom`.*, `classroom`.`name` AS kelas, `prodi`.`name` AS prodi,
        `classroom_users`.`accepted`, `classroom_users`.`date_accepted`,
        `classroom_users`.`time_group`
        FROM `classroom_users` 
        LEFT JOIN `classroom` ON `classroom`.`id` = `classroom_users`.`classroom_id`
        LEFT JOIN `prodi` ON `prodi`.`id` = `classroom`.`prodi_id`
        WHERE `classroom_users`.`classroom_id` = " . $classId;
        return $this->db->query($query)->row_array();
    }
}
