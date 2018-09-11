<?php
include_once 'app_pars.php';
$prs = new pars_app;
while (1){
	/*
	Тестовый класс, на основе которого можно сделать скрипт для мониторинга
	Тут идет подключение к БД
	$a - массив хостов - аппирок, где 
	$a->name - имя аппирки\IP
	*/
	print "Start\n";
	$file = date("Y-m-d").'-rgs.txt';
	$current = file_get_contents($file);
	while ( $a = $dbNF->FetchObject() ){
		$name = $a->name;
		print $name."\n";
		$prs->spisok = array();
		$prs->app_pars('http://'.$name);
		foreach($prs->spisok as &$value){ $current .=  date("Y-m-d H:i:s").";".$name.";".$value['ip'].";".$value['err']."\n"; }
	}
	file_put_contents($file, $current);
	sleep (300);
}