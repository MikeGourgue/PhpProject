<?php
include_once('utility/my_password_utility.php');
session_start();

class crud
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function create($name,$email,$hash)
	{
		try
		{
			$stmt = $this->db->prepare('INSERT INTO users(username, email, password) VALUES(:name, :email, :hash)');
			$stmt->bindparam(':name',$name);
			$stmt->bindparam(':email',$email);
			$stmt->bindparam(':hash',$hash);
			$stmt->execute();
			return 'user sucressfully create!';
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return 'you screwed somewhere';
		}
	}

	public function login($email, $hash, $remember)
	{
		$stmt = $this->db->prepare('SELECT * FROM users WHERE email=:email');
		$stmt->execute(array(':email'=>$email));
		if ($stmt->rowCount()) {
			$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if (my_password_compare($hash, $editRow['password'])) {
				if ($remember == 'on') {
					setcookie('auth', json_encode($editRow), Time() + 5000);
				}
				$_SESSION['auth'] = json_encode($editRow);
				return $editRow['id'];
			} else {
				return 'wrong password';
			}
		} else {
			return 'no such mail';
		}
	}
}
