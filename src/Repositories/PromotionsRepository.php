<?php


class PromotionsRepository extends Database implements RepositoryInterface
{
  public function getAll()
  {
    // logique pour récupérer toutes les instances
    $database = $this->getDb();
    $query = 'SELECT * FROM promotions';
    $statement = $database->query($query);
    $promotions = $statement->fetchAll(PDO::FETCH_CLASS, Promotion::class);
    return $promotions;
  }

  public function getById($id)
  {
    $database = $this->getDb();
    $query = 'SELECT * FROM promotions WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data, $id)
  {
    $database = $this->getDb();
    $query = 'UPDATE promotions SET name=:name, startDate=:startDate, endDate=:endDate, places=:places WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':name', $data['name']);
    $statement->bindParam(':startDate', $data['startDate']);
    $statement->bindParam(':endDate', $data['endDate']);
    $statement->bindParam(':places', $data['places']);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function delete($id)
  {
    // logique pour supprimer un instance
    $database = $this->getDb();
    $query = 'DELETE FROM promotions WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function create($data)
  {
    $database = $this->getDb();
    $query = 'INSERT INTO promotions (name, startDate, endDate, places) VALUES (:name, :startDate, :endDate, :places)';
    $statement = $database->prepare($query);
    $statement->bindParam(':name', $data['name']);
    $statement->bindParam(':startDate', $data['startDate']);
    $statement->bindParam(':endDate', $data['endDate']);
    $statement->bindParam(':places', $data['places']);
    $result = $statement->execute();
    return $result;
  }
}
