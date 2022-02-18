<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\ServiceProvider;

class massUpdateService extends ServiceProvider
{
    /**
     * Для массового обновления сортировки передаём данные в формате
     *
     * $data =
     *  {
     * sort[item.sort] = {
     * 'id': item.id,
     * 'sort': item.sort
     *  }
     * };
     * @return void
     */
    public static function massUpdate($data, $instance)
    {
        $sorting = self::preparationDataForMassUpdate($data);
        batch()->update($instance, $sorting, 'id');
    }

    protected static function preparationDataForMassUpdate($data)
    {
        $sort = json_decode($data);
        $res = [];
        foreach ($sort as $item) {
            $item = json_decode(json_encode($item), true);
            $res[] = $item;
        }
        return $res;
    }
}
