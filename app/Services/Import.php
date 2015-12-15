<?php

namespace App\Services;

use App\Log;
use App\User;
use App\Fuel;

class Import
{
    protected $orgs = 'orgs*.csv';
    protected $fuel = 'fuel*.csv';

    public function __construct($orgs = NULL, $fuel = NULL)
    {
        if (isset($orgs))
        {
            $this->orgs = $orgs;
        }

        if (isset($fuel))
        {
            $this->fuel = $fuel;
        }

        $this->orgs = public_path() . '/' . $this->orgs;
        $this->fuel = public_path() . '/' . $this->fuel;
    }

    public static function getImport() {
        return new static();
    }

    public function import()
    {
        echo 'Поиск файлов по шаблону' . PHP_EOL;
        foreach (glob($this->orgs) as $filename) {
            $client = $filename;
            echo 'Файл организаций найден ' . $client . PHP_EOL;
        }
        foreach (glob($this->fuel) as $filename) {
            $cardUses = $filename;
            echo 'Файл использований карты найден ' . $cardUses . PHP_EOL;
        }

        //Обработка файла с организациями
        echo 'Обработка организаций' . PHP_EOL;
        if (Log::isFileChanged('orgs', $client)) {
            $array = array();
            $header = NULL;
            if (($handle = fopen($client, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if (!$header)
                        $header = $row;
                    else
                        $array[] = $row;
                }
                fclose($handle);
            }
            else {
                echo 'Файл не удалось открыть' . PHP_EOL;
            }
            $count = 0;
            foreach ($array as $a) {
                $row = User::where('inn', $a[1])->first();
                if (!$row) {
                    $count += 1;
                    User::create(['name' => $a[0], 'inn' => $a[1], 'password' => bcrypt($a[2]), 'superUser' => 0]);
                }
            }
            echo 'Было добавлено ' . $count . ' записей' . PHP_EOL;
            unlink($client);
        }
        else {
            echo 'Новых записей не было найдено' . PHP_EOL;
        }

        //Обработка файла использований карты
        echo 'Обработка использований карты' . PHP_EOL;
        if (Log::isFileChanged('fuel', $cardUses)) {
            $array = array();
            $header = NULL;
            if (($handle = fopen($cardUses, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if (!$header)
                        $header = $row;
                    else
                        $array[] = $row;
                }
                fclose($handle);
            }
            else {
                echo 'Файл не удалось открыть' . PHP_EOL;
            }
            $count = 0;
            foreach ($array as $a) {
                $count += 1;
                Fuel::create(['org_id' => $a[0], 'date' => $a[1], 'station' => $a[2], 'value' => $a[3], 'car' => $a[4]]);
            }
            echo 'Было добавлено ' . $count . ' записей' . PHP_EOL;
            unlink($cardUses);
        }
        else {
            echo 'Новых записей не было найдено' . PHP_EOL;
        }
    }
}
