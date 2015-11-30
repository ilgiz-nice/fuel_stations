<?php

namespace App\Services;

use App\Log;
use App\User;
use App\Fuel;

class Import
{
    protected $orgs = 'orgs_*.csv';
    protected $fuel = 'fuel_*.csv';

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
        //Поиск файлов
        foreach (glob($this->orgs) as $filename) {
            $client = $filename;
        }
        foreach (glob($this->fuel) as $filename) {
            $cardUses = $filename;
        }

        //Обработка файла с организациями
        if (Log::isFileChanged('orgs', $client)) {
            $array = array();
            $header = NULL;
            if (($handle = fopen($client, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if (!$header)
                        $header = $row;
                    else
                        $array[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            $count = 0;
            $list = NULL;
            foreach ($array as $a) {
                $row = User::where('inn', $a['inn'])->first();
                if (!$row) {
                    $count += 1;
                    $list .= $a['name'];
                    User::create(['name' => $a['name'], 'inn' => $a['inn'], 'password' => bcrypt($a['password'])]);
                }
            }
        }

        //Обработка файла использований карты
        if (Log::isFileChanged('fuel', $cardUses)) {
            $array = array();
            $header = NULL;
            if (($handle = fopen($cardUses, 'r')) !== FALSE) {
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if (!$header)
                        $header = $row;
                    else
                        $array[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            $count = 0;
            foreach ($array as $a) {
                $count += 1;
                //
                Fuel::create(['org_id' => $a['org_id'], 'date' => $a['date'], 'station' => $a['station'], 'value' => $a['value'], 'car' => $a['car']]);
            }
        }
    }
}
