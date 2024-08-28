<?php

namespace App\Model;

// class TaskManager
class TaskManager extends Manager
{
    public function readAll()
    {

        $sql = "
        SELECT 
            *
        FROM 
            V_tasks;
        ";

        $result = $this->request('App\Model\Task', $sql);

        return $result;
    }
    public function readOne($id)
    {

        $sql = "
        SELECT 
            *
        FROM 
            V_tasks
        WHERE
            id=?;
        ";

        $result = $this->request('App\Model\Task', $sql, [$id]);

        return $result;
    }
    public function update($values)
    {
        $sql = "
            UPDATE
                tasks
            SET
                title=?,
                description=?,
                status=?,
                `order`=?
            WHERE
                id=?;
        ";

        $result = $this->request('App\Model\Task', $sql, [$values->getTitle(), $values->getDescription(), $values->getStatus(), intval($values->getOrder()), intval($values->getId())]);

        return $this->readOne($values->getId());
    }
    public function create($values)
    {
        $sql = "
            INSERT INTO
        tasks (title,`description`,`status`,`order`)
        VALUES
        (?,?,?,?);
        ";


        $data = [$values->getTitle(), $values->getDescription(), intval($values->getStatus()), intval($values->getOrder())];

        // var_dump($data[0]);
        // die;

        $this->request('App\Model\Task', $sql, $data);

        $sql = "
        SELECT LAST_INSERT_ID();
        ";
        $lastId = $this->request(null, $sql);

        // var_dump($lastId["LAST_INSERT_ID()"]);

        // die;

        return $this->readOne($lastId["LAST_INSERT_ID()"]);
    }

    public function delete($values)
    {
        $sql = "
            DELETE FROM
            tasks
            WHERE
            id=?;
        ";

        // var_dump($values->getID());

        // die;

        $result = $this->request('App\Model\Task', $sql, [$values->getID()]);

        return $this->readOne($values->getId());
    }
}
