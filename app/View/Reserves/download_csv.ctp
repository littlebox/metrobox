<?php
 $line = $output[0];
 $this->CSV->addRow(array_keys($line));
 foreach ($output as $row){
	$line = $row;
	$this->CSV->addRow($line);
 }
 $filename='Reservas desde '.$dates['from'].' hasta '.$dates['to'];
 echo $this->CSV->render($filename, 'UTF-16LE');
?>