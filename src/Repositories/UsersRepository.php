<?php


class UsersRepository extends Database implements RepositoryInterface
{
  public function getAll()
  {
    // logique pour récupérer toutes les instances
    $database = $this->getDb();
    $query = 'SELECT * FROM users';
    $statement = $database->query($query);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  public function getById($id)
  {
    // logique pour récupérer une instance par son id
    $database = $this->getDb();
    $query = 'SELECT * FROM users WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $promotion = $statement->fetch(PDO::FETCH_CLASS, User::class);
    return $promotion;
  }

  public function update($data, $id)
  {
    // logique pour mettre à jour une instance
    $database = $this->getDb();
    $query = 'UPDATE roles SET firstName=:firstName lastName=:lastName active=:active email=:email password=:password roleId=roleId WHERE id=:id';
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

  public function delete($id)
  {
    // logique pour supprimer un instance
    $database = $this->getDb();
    $query = 'DELETE users WHERE id=:id';
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
