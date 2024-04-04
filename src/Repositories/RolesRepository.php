<?php


class RolesRepository extends Database implements RepositoryInterface
{
  public function getAll()
  {
    // logique pour récupérer toutes les instances
    $database = $this->getDb();
    $query = 'SELECT * FROM roles';
    $statement = $database->query($query);
    $roles = $statement->fetchAll(PDO::FETCH_CLASS, Role::class);
    return $roles;
  }

  public function getById($id)
  {
    // logique pour récupérer une instance par son id
    $database = $this->getDb();
    $query = 'SELECT * FROM roles WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return  $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data, $id)
  {
    // logique pour mettre à jour une instance
    $database = $this->getDb();
    $query = 'UPDATE roles SET name=:name WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':name', $data['name']);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function delete($id)
  {
    // logique pour supprimer un instance
    $database = $this->getDb();
    $query = 'DELETE FROM roles WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function create($data)
  {
    $database = $this->getDb();
    $query = 'INSERT INTO roles (name) VALUES (:name)';
    $statement = $database->prepare($query);
    $statement->bindParam(':name', $data['name']);
    $result = $statement->execute();
    return $result;
  }
}
