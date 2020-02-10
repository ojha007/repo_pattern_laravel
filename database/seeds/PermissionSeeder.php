<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = app_path() . "/Entities";
        $permissions = ['all', 'view', 'create', 'edit', 'delete'];
        foreach ($this->getModels($path) as $key1 => $model) {
            foreach ($permissions as $key2 => $permission) {
                Permission::findOrCreate($model . '-' . $permission, 'Api');
            }
        }

    }
   public function getModels($path)
    {
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            } else {
                $out[] = strtolower(basename(substr($filename, 0, -4)));
            }
        }
        return $out;
    }
}
