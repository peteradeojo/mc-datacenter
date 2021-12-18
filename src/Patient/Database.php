<?php

namespace Patient;

use mysqli;
use Exception;

class Database
{
	private \mysqli $cxn;

	function __construct()
	{
	}

	function connect(): bool
	{
		$cxn = new mysqli($_ENV['DBHOST'], $_ENV['DBUSER'], $_ENV['DBPASSWD'], $_ENV['DBNAME']);
		if ($cxn->error) {
			throw new Exception('Failed to connect to database: ' + $cxn->error);
			return false;
		}
		$this->cxn = $cxn;
		return true;
	}

	function insert(array $rows_values): bool
	{
		$sql = "";
		foreach ($rows_values as $table => $data) {
			// # code...
			$sql .= "INSERT INTO $table ";
			$sql .= "(" . join(",", array_keys($data)) . ") ";
			$sql .= "VALUES (";
			$beep = array_map(function ($value) use ($sql) {
				if ($value) {
					return "'$value'";
				} else {
					return "null";
				}
			}, array_values($data));
			$sql .= join(',', $beep);
			$sql .= ");";
		}

		try {
			if (count($rows_values) > 1) {
				$result = $this->cxn->multi_query($sql);
			} else {
				$result = $this->cxn->query($sql);
			}

			if ($result) {
				return true;
			} else {
				throw new Exception($this->cxn->error);
			}
		} catch (Exception $e) {
			// echo $this->cxn->error;
			throw new Exception($e->getMessage());
			// return false;
		}
	}

	function select(string $table, string $rows = '*', string $where = null, int $limit = null, string $order = null)
	{
		$sql = "SELECT $rows FROM $table";
		if ($where) {
			$sql .= " WHERE $where";
		}

		$result = $this->cxn->query($sql);
		if ($result) {
			return $result->fetch_all(MYSQLI_ASSOC);
		} else {
			if ($this->cxn->error) {
				throw new Exception($this->cxn->error);
			}
		}
		return [];
	}

	function updateRecord(array $rows_values, string $where, bool $conditionalInsert = false)
	{
		// print_r($rows_values);
		$sql = "";
		foreach ($rows_values as $table => $data) {
			$beep = array_map(function ($value) use ($sql) {
				return "'$value'";
			}, array_values($data));
			if (!$conditionalInsert) {
				// # code...
				$sql .= "UPDATE $table ";
				$sql .= "SET ";
				for ($i = 0; $i < count(array_keys($data)); $i += 1) {
					$sql .= array_keys($data)[$i] . "=" . $beep[$i];
					if ($i < count(array_keys($data)) - 1) {
						$sql .= ", ";
					}
				}
				$sql .= " WHERE $where;";
			} else {
				# code...
				$sql .= "REPLACE INTO $table (" . join(',', array_keys($data)) . ") VALUES (" . join(',', $beep) . ");";
			}
		}

		// echo $sql;
		// exit();

		try {
			if (count($rows_values) > 1) {
				$result = $this->cxn->multi_query($sql);
			} else {
				$result = $this->cxn->query($sql);
			}
			if ($result) {
				return true;
			} else {
				throw new Exception($this->cxn->error);
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function __destruct()
	{
		$this->cxn->close();
	}
}
