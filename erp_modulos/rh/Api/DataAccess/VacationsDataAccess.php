<?php

namespace Api\DataAccess;

use Api\Connectors\DatabaseConnector;
use PDO;
use PDOException;

class VacationsDataAccess
{

    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = (new DatabaseConnector())->connection();
    }

    public function selectAll()
    {
        try {
            $stmt = $this->dbConnection->query('SELECT vac.id AS id, employeeId, emp.mothersLastname AS employeeMothersLastname, emp.lastname AS employeeLastname, emp.name AS employeeName, vacationFrom, vacationTo, vacationRequested, vacationStatus, vacationSupervisor, vacationUser  FROM vacaciones_empleados_rh vac JOIN empleados_rh emp ON vac.employeeId = emp.id');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function select($id)
    {
        $stmt = $this->dbConnection->prepare('SELECT vac.id AS id, dep.id AS department, dep.name AS departmentName, employeeId,emp.mothersLastname AS employeeMothersLastname, emp.lastname AS employeeLastname, emp.name AS employeeName, vacationFrom, vacationTo, vacationRequested, vacationStatus, vacationSupervisor, vacationUser  FROM vacaciones_empleados_rh vac JOIN empleados_rh emp ON vac.employeeId = emp.id JOIN departamentos_rh dep ON emp.department = dep.id WHERE vac.id = ?');
        try {
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectByUser($user)
    {
        $stmt = $this->dbConnection->prepare('SELECT vac.id AS id, dep.id AS department, dep.name AS departmentName, employeeId, emp.mothersLastname AS employeeMothersLastname, emp.lastname AS employeeLastname, emp.name AS employeeName, vacationFrom, vacationTo, vacationRequested, vacationStatus, vacationSupervisor, vacationUser  FROM vacaciones_empleados_rh vac JOIN empleados_rh emp ON vac.employeeId = emp.id JOIN departamentos_rh dep ON emp.department = dep.id WHERE vacationUser = ?');
        try {
            $stmt->execute(array($user));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function selectBySupervisor($supervisor)
    {
        $stmt = $this->dbConnection->prepare('SELECT vac.id AS id, dep.id AS department, dep.name AS departmentName, employeeId, emp.mothersLastname AS employeeMothersLastname, emp.lastname AS employeeLastname, emp.name AS employeeName, vacationFrom, vacationTo, vacationRequested, vacationStatus, vacationSupervisor, vacationUser  FROM vacaciones_empleados_rh vac JOIN empleados_rh emp ON vac.employeeId = emp.id JOIN departamentos_rh dep ON emp.department = dep.id WHERE vacationSupervisor = ?');
        try {
            $stmt->execute(array($supervisor));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert($data)
    {
        $values = json_decode($data, true);
        $stmt = $this->dbConnection->prepare('INSERT INTO vacaciones_empleados_rh (employeeId, vacationFrom, vacationTo, vacationRequested, vacationStatus, vacationSupervisor, vacationUser) VALUES ( :employeeId, :vacationFrom, :vacationTo, :vacationRequested, 1, :vacationSupervisor, :vacationUser);');
        try {
            $stmt->execute(array_map('trim', $values));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, $data)
    {
        $values = json_decode($data, true);
        $values['id'] = $id;
        $stmt = $this->dbConnection->prepare('UPDATE vacaciones_empleados_rh SET employeeId = :employeeId, vacationFrom = :vacationFrom, vacationTo = :vacationTo, vacationRequested = :vacationRequested, vacationStatus = :vacationStatus, vacationSupervisor = :vacationSupervisor, vacationUser = :vacationUser WHERE id = :id');
        try {
            $stmt->execute(array_map('trim', $values));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM vacaciones_empleados_rh WHERE id = ?');
        try {
            $stmt->execute(array($id));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}
