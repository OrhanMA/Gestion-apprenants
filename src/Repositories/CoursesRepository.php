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


  public function getUserCourses($userId)
  {
    $database = $this->getDb();
    $query = 'SELECT 
    uc.id AS user_course_id, 
    uc.present AS present, 
    uc.late AS late, 
    c.date AS course_date, 
    c.period AS course_period, 
    p.name AS promotion_name,
    p.places AS promotion_places
FROM 
    user_course uc
JOIN 
    users u ON uc.userId = u.id
JOIN 
    courses c ON uc.courseId = c.id
JOIN 
    promotions p ON c.promotionId = p.id
WHERE 
    uc.userId = :userId;
';
    $statement = $database->prepare($query);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function signUserCourse($id)
  {
    $present = 1;
    $database = $this->getDb();
    $query = 'UPDATE user_course SET present=:present WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':present', $present);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function getUserCourseById($id)
  {
    $database = $this->getDb();
    $query = 'SELECT * FROM user_course WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    // logique pour récupérer une instance par son id
    $database = $this->getDb();
    $query = 'SELECT * FROM courses WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function update($data, $id)
  {
    // logique pour mettre à jour une instance
    $database = $this->getDb();
    $query = 'UPDATE courses SET date=:date, period=:period, promotionId=:promotionId WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':date', $data['date']);
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
    $query = 'DELETE FROM courses WHERE id=:id';
    $statement = $database->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();
    return $result;
  }

  public function create($data)
  {
    $database = $this->getDb();
    $query = 'INSERT INTO courses (date, period, promotionId) VALUES (:date, :period, :promotionId)';
    $statement = $database->prepare($query);
    $statement->bindParam(':date', $data['date']);
    $statement->bindParam(':period', $data['period']);
    $statement->bindParam(':promotionId', $data['promotionId']);
    $result = $statement->execute();
    return $result;
  }
}
