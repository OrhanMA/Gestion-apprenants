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
    // logique pour récupérer une instance par son id
    $database = $this->getDb();
    $query = 'SELECT * FROM promotions WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $promotion = $statement->fetch(PDO::FETCH_CLASS, Promotion::class);
    return $promotion;
  }

  public function update($data, $id)
  {
    // logique pour mettre à jour une instance
    $database = $this->getDb();
    $query = 'UPDATE roles SET name=:name startDate=:startDate endDate=:endDate places=:places WHERE id=:id';
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
    $query = 'DELETE promotions WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }
}
