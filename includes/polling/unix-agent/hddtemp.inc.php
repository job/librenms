<?php

global $agent_sensors;

require_once 'includes/discovery/functions.inc.php';

if ($agent_data['haddtemp'] != '|') {
    $disks = explode('||', trim($agent_data['hddtemp'], '|'));

    if (count($disks)) { 
        echo 'hddtemp: ';
        foreach ($disks as $disk)
        {
            list($blockdevice,$descr,$temperature,$unit) = explode('|', $disk, 4);
            $diskcount++;
            discover_sensor($valid['sensor'], 'temperature', $device, '', $diskcount, 'hddtemp', "$blockdevice: $descr", '1', '1', null, null, null, null, $temperature, 'agent');

            $agent_sensors['temperature']['hddtemp'][$diskcount] = array(
                'description' => "$blockdevice: $descr",
                'current'     => $temperature,
                'index'       => $diskcount,
            );
        }

        echo "\n";
    }
}//end if
