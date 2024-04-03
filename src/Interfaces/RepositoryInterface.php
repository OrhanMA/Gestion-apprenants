<?php

interface RepositoryInterface
{
  public function getAll();
  public function getById($id);
  public function update($data, $id);
  public function delete($id);
  public function create($data);
}
