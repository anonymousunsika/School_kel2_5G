<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getMembers($contain = null)
    {
        $query = "SELECT * FROM (
        SELECT `user`.*, `classroom_users`.`classroom_id`,
        `classroom`.`name` AS kelas, `prodi`.`name` AS jurusan,
        row_number() OVER (PARTITION BY lower(`user`.`id`)) AS rn
        FROM `user` LEFT JOIN `prodi` ON `user`.`prodi_id` = `prodi`.`id`
        LEFT JOIN `classroom_users`
        ON `user`.`id` = `classroom_users`.`user_id`
        LEFT JOIN `classroom`
        ON `classroom_users`.`classroom_id` = `classroom`.`id` WHERE `user`.`role_id` = 2 " . ($contain != null ?
            "AND (`user`.`name` LIKE " . '%' . $contain . '%' .
            "OR `user`.`npm` LIKE " . '%' . $contain . '%' . ")" : "") . ")t WHERE rn = 1";

        return $this->db->query($query)->result_array();
    }

    public function getSchedule($classId, $timeGroup)
    {
        $query = "SELECT `schedule`.*, `classroom`.`name` AS kelas, `classroom`.`semester`,
         `prodi`.`name` AS jurusan, `course`.`name` AS mk, `course`.`sks`
        FROM `schedule` 
        LEFT JOIN `classroom` ON `schedule`.`classroom_id` = `classroom`.`id`
        LEFT JOIN `course` ON `schedule`.`course_id` = `course`.`id`
        LEFT JOIN `prodi` ON `prodi`.`id` = `classroom`.`prodi_id`
        WHERE `classroom`.`id` = " . $classId . " AND `schedule`.`timeGroup` = " . $timeGroup;

        return $this->db->query($query)->result_array();
    }

    public function getTimeGroup($classId)
    {
        $query = "SELECT `timeGroup` FROM `schedule` 
        WHERE `classroom_id` = " . $classId . "
        GROUP BY `timeGroup`";

        return $this->db->query($query)->result_array();
    }

    public function getSemester()
    {
        $query = "SELECT `semester` FROM `classroom` GROUP BY `semester`";

        return $this->db->query($query)->result_array();
    }

    public function getClassroom($semester = null)
    {
        $query = "SELECT `classroom`.*, `prodi`.`name` AS prodi
        FROM `classroom` LEFT JOIN `prodi` ON `classroom`.`prodi_id` = `prodi`.`id`
        " . ($semester != null ? "WHERE `classroom`.`semester` = " . $semester : '');
        return $this->db->query($query)->result_array();
    }

    public function getStudents($classId)
    {
        $query = "SELECT `classroom_users`.*, `classroom`.`semester`, `classroom`.`name` AS kelas, `user`.`name`,`user`.`npm`
        FROM `classroom_users` 
        LEFT JOIN `classroom` ON `classroom_users`.`classroom_id` = `classroom`.`id`
        LEFT JOIN `user` ON `classroom_users`.`user_id` = `user`.`id`
        WHERE `classroom`.`id` = " . $classId;

        return $this->db->query($query)->result_array();
    }
}
