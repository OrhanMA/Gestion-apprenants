<?php


class CoursesRepository extends Database implements RepositoryInterface
{
  public function getAll()
  {
    // logique pour récupérer toutes les instances
    $database = $this->getDb();
    $query = 'SELECT * FROM courses';
    $statement = $database->query($query);
    $courses = $statement->fetchAll(PDO::FETCH_CLASS, Course::class);
    return $courses;
  }

  public function getById($id)
  {
    // logique pour récupérer une instance par son id
    $database = $this->getDb();
    $query = 'SELECT * FROM courses WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $course = $statement->fetch(PDO::FETCH_CLASS, Course::class);
    return $course;
  }

  public function update($data, $id)
  {
    // logique pour mettre à jour une instance
    $database = $this->getDb();
    $query = 'UPDATE courses SET name=:name period=:period promotionId=:promotionId WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':name', $data['name']);
    $statement->bindParam(':period', $data['period']);
    $statement->bindParam(':promotionId', $data['promotionId']);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function delete($id)
  {
    // logique pour supprimer un instance
    $database = $this->getDb();
    $query = 'DELETE courses WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function create($data) {
    $database = $this->getDb();
    //TODO
  }
}
