<?php

namespace Modules\Iblog\Repositories;

use Modules\Core\Repositories\BaseRepository;

/**
 * Interface CategoryRepository
 * @package Modules\Iblog\Repositories
 */
interface CategoryRepository extends BaseRepository
{
  /**
   * @param $params
   * @return mixed
   */
  public function getItemsBy($params);
  
  /**
   * @param $criteria
   * @param $params
   * @return mixed
   */
  public function getItem($criteria, $params);
  
  
  public function create($data);
  
  public function updateBy($criteria, $data, $params);
  
  public function deleteBy($criteria, $params);
  
}
