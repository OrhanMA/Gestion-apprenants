<?php


class UsersRepository extends Database implements RepositoryInterface
{
  public function getAll()
  {
    $database = $this->getDb();
    $query = 'SELECT * FROM users';
    $statement = $database->query($query);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  public function getByEmail($email)
  {
    $database = $this->getDb();
    $query = 'SELECT * FROM users WHERE email=:email';
    $statement = $database->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function checkPasswordSet($id)
  {
    $database = $this->getDb();
    $query = 'SELECT password FROM users WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['password'] !== null) {
      return true;
    } else {
      return false;
    }
  }

  public function getByEmailSecureData($email)
  {
    $database = $this->getDb();
    $query = 'SELECT id, firstName, lastName, active, email, roleId FROM users WHERE email=:email';
    $statement = $database->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $database = $this->getDb();
    $query = 'SELECT * FROM users WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data, $id)
  {
    $database = $this->getDb();
    $query = 'UPDATE users SET firstName=:firstName, lastName=:lastName, active=:active, email=:email, password=:password, roleId=:roleId WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':firstName', $data['firstName']);
    $statement->bindParam(':lastName', $data['lastName']);
    $statement->bindParam(':active', $data['active']);
    $statement->bindParam(':email', $data['email']);
    $statement->bindParam(':password', $data['password']);
    $statement->bindParam(':roleId', $data['roleId']);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function updatePassword($password, $id)
  {
    $database = $this->getDb();
    $active = 1;
    $query = 'UPDATE users SET password=:password, active=:active WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':active', $active);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function delete($id)
  {
    $database = $this->getDb();
    $query = 'DELETE FROM users WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function create($data)
  {
    $database = $this->getDb();
    $query = 'INSERT INTO users (firstName, lastName, active, email, password, roleId) VALUES (:firstName, :lastName, :active, :email, :password, :roleId)';
    $statement = $database->prepare($query);
    $statement->bindParam(':firstName', $data['firstName']);
    $statement->bindParam(':lastName', $data['lastName']);
    $statement->bindParam(':active', $data['active'], PDO::PARAM_INT);
    $statement->bindParam(':email', $data['email']);
    $statement->bindParam(':password', $data['password']);
    $statement->bindParam(':roleId', $data['roleId'], PDO::PARAM_INT);
    $result = $statement->execute();
    return $result;
  }
}
