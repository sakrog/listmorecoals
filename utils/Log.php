<?php

class Log
{

	protected $filename = '';

	public function setFilename($filename)
	{
		$this->filename = 'log-' . date('Y-m-d') . '.log';
	}

	public function getFilename()
	{
		return $this->filename;
	}

	public function logMessage($logLevel, $message){

		$dateWithTime = date('Y-m-d H:i:s');

		$handle = fopen(getFilename(), 'a');
		$formattedMessage = "$dateWithTime [{$logLevel}] {$message}";

		fwrite($handle, PHP_EOL . $formattedMessage . PHP_EOL);
    	fclose($handle);
	}

	public function logInfo($message){
		return $this->logMessage("INFO", $message);
	}

	public function logError($message){
		return $this->logMessage("ERROR", $message);
	}

}


?>