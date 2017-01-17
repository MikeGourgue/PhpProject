<?php
include_once('utility/my_password_utility.php');

class User
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function create($name,$email,$hash, $admin = 0)
	{
		try
		{
			$stmt = $this->db->prepare('INSERT INTO users(username, email, password, admin) VALUES(:name, :email, :hash, :admin)');
			$stmt->bindparam(':name',$name);
			$stmt->bindparam(':email',$email);
			$stmt->bindparam(':hash',$hash);
			$stmt->bindparam(':admin',$admin);


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

	public function getID($id)
	{
		$stmt = $this->db->prepare('SELECT * FROM users WHERE id=:id');
		$stmt->execute(array(':id'=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function update($id,$name,$email,$hash,$admin = 0)
	{
		try
		{
			$stmt=$this->db->prepare('UPDATE users SET username=:name,
														 											email=:email,
														 											password=:hash,
																									admin=:admin
																									WHERE id=:id ');
			$stmt->bindparam(':name',$name);
			$stmt->bindparam(':email',$email);
			$stmt->bindparam(':hash',$hash);
			$stmt->bindparam(':admin',$admin);
			$stmt->bindparam(':id',$id);
			$stmt->execute();

			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	public function delete($id)
	{
		$stmt = $this->db->prepare('DELETE FROM users WHERE id=:id');
		$stmt->bindparam(':id',$id);
		$stmt->execute();
		return true;
	}

	/* paging */

	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
								<tr>
								<td><?php print($row['id']); ?></td>
								<td><?php print($row['username']); ?></td>
								<td><?php print($row['email']); ?></td>
								<td><?php print($row['admin']); ?></td>
								<td align='center'>
								<a href='edit-user.php?edit_id=<?php print($row['id']); ?>'><i class='glyphicon glyphicon-edit'></i></a>
								</td>
								<td align='center'>
								<a href='delete-user.php?delete_id=<?php print($row['id']); ?>'><i class='glyphicon glyphicon-remove-circle'></i></a>
								</td>
								</tr>
								<?php
			}
		}
		else
		{
			?>
						<tr>
						<td>Nothing here...</td>
						</tr>
						<?php
		}

	}

	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET['page_no']))
		{
			$starting_position=($_GET['page_no']-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}

	public function paginglink($query,$records_per_page)
	{

		$self = $_SERVER['PHP_SELF'];

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$total_no_of_records = $stmt->rowCount();

		if($total_no_of_records > 0)
		{
			?><ul class='pagination'><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET['page_no']))
			{
				$current_page=$_GET['page_no'];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}

	/* paging */
}
