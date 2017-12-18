<?php


$count = 5;

$res = array();

$rnd_passport = array('14-18','18-45','45-100');

while($count!=0)
{
	$passport = generatepassport();
	$age = $rnd_passport[rand(0,2)];

	for($i=1;$i<13;$i++){
		$salary = 20000+rand(0,30000);
		$res[] = array('passport'=>$passport,'month'=>$i,'about'=>array('salary'=>$salary,'count'=>rand(0,3),'agevalue'=>$age));
	}

	$count--;
}

$res = json_encode($res);
//file_put_contents('datatoflume.txt', $res);

file_put_contents('datatoflume.json', $res);
filetotest($res);


function generatepassport()
{
	$pass = 800100+rand(0,50);
	return "6303".$pass;
}



function filetotest($resourse)
{
	$resourse = json_decode($resourse);

	$res_data = array();
	$res_data2 = array();

	$result_file = "+------+--------+---------+\n|   age|countavg|salaryavg|\n+------+--------+---------+\n";

	foreach($resourse as $resitem)
	{

		$res_data[$resitem->{'about'}->{'agevalue'}]['age'] = $resitem->{'about'}->{'agevalue'};
		$res_data[$resitem->{'about'}->{'agevalue'}]['salary'][] = $resitem->{'about'}->{'salary'};
		$res_data[$resitem->{'about'}->{'agevalue'}]['count'][] = $resitem->{'about'}->{'count'};
	}
	global $rnd_passport;


	foreach($rnd_passport as $resrnd)
	{

		/*if(!isset($res_data[$resrnd]))
		{
			//$result_file.="|".str_pad($resrnd,6,' ', STR_PAD_LEFT)."|".str_pad("0.0",8,' ', STR_PAD_LEFT)."|".str_pad("0.0",9,' ', STR_PAD_LEFT)."|\n";
			
		}else{*/
		if(isset($res_data[$resrnd]))
			$resitemdata = $res_data[$resrnd];
			$countavg=0;
			$salaryavg=0;
		
			foreach($resitemdata['salary'] as $itemsalary)
			{
				$salaryavg+=$itemsalary;
			
			}
			foreach($resitemdata['count'] as $itemcount)
			{
				$countavg+=$itemcount;
			
			}
			$salaryavg = round($salaryavg/count($resitemdata['salary'])).".0";
		
			$countavg = round($countavg/count($resitemdata['count'])).".0";

			$result_file.="|".str_pad($resitemdata['age'],6,' ', STR_PAD_LEFT)."|".str_pad($countavg,8,' ', STR_PAD_LEFT)."|".str_pad($salaryavg,9,' ', STR_PAD_LEFT)."|\n";
		}
	}
	$result_file .= "+------+--------+---------+\n";

	echo $result_file;

	file_put_contents('hw2test-source.txt', $result_file);
}
