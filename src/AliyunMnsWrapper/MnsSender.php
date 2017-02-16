<?php
namespace AliyunMnsWrapper\AliyunMnsWrapper;

use AliyunMNS\Client;
use AliyunMNS\Requests\SendMessageRequest;
use AliyunMNS\Requests\CreateQueueRequest;
use AliyunMNS\Exception\MnsException;

class MnsSender
{
	private $accessId;
    private $accessKey;
    private $endPoint;
    private $client;

	function __construct($accessId, $accessKey, $endPoint)
	{
		$this->accessId = $accessId;
        $this->accessKey = $accessKey;
        $this->endPoint = $endPoint;
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
	}

	public function set_access_config($accessId , $accessKey , $endPoint)
	{
		$this->accessId = $accessId;
        $this->accessKey = $accessKey;
        $this->endPoint = $endPoint;
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
	}

	public function send($queueName , $messageBody)
	{
		try {
			$queue = $this->client->getQueueRef($queueName);
			$request = new SendMessageRequest($messageBody);
			return ['status' => 1 , 'message' => $queue->sendMessage($request)];
		} catch (MnsException $e) {
			return ['status' => 0 , 'message' => $e->getMessage()];
		}

	}

	public function multi_send($queueName , $multiMessageBody)
	{
		# code...
	}

}
