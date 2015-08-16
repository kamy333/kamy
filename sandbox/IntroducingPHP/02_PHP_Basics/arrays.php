<?php
$characters = array('Arthur Dent', 'Ford Prefect', 'Zaphod Beeblebrox');
//echo $characters;
//print_r($characters);
//echo $characters[1];
$characters[] = 'Marvin';
$characters[] = 'Slartibartfast';
//print_r($characters);
$descriptions = array('Earth' => 'mostly harmless',
                      'Marvin' => 'the paranoid android');
$descriptions['Zaphod'] = 'President of the Imperial Galactic Government';
echo "Earth is described as {$descriptions['Earth']}";