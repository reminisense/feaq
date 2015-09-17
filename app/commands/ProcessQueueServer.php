<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessQueueServer extends Command {

    private $business_clients = array();
	private $broadcast_clients = array();
	private $clients;
	private $host; //host
	private $port; //port
	private $null = NULL; //null var

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'websocket:queue';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
        $this->host = 'localhost';
        $this->port = '55347';
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		try{
			$this->start();
		}catch(Exception $e){
			var_dump($e);
			$this->fire();
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

	public function start(){
		//Create TCP/IP sream socket
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		//reuseable port
		socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

		//bind socket to specified host
		socket_bind($socket, 0, $this->port);

		//listen to port
		socket_listen($socket);

		//create & add listning socket to the list
		$this->clients = array($socket);

		//start endless loop, so that our script doesn't stop
		while (true) {
			//manage multipal connections
			$changed = $this->clients;
			//returns the socket resources in $changed array
			socket_select($changed, $this->null, $this->null, 0, 10);

			//check for new socket
			if (in_array($socket, $changed)) {
				$socket_new = socket_accept($socket); //accpet new socket
				$this->clients[] = $socket_new; //add socket to client array

				$header = socket_read($socket_new, 1024); //read data sent by the socket
				$this->perform_handshaking($header, $socket_new, $this->host, $this->port); //perform websocket handshake

				socket_getpeername($socket_new, $ip); //get ip address of connected socket
				//$response = mask(json_encode(array('type'=>'system', 'terminal'=>$ip.' connected'))); //prepare json data
				//send_message($response); //notify all users about new connection

				//make room for new socket
				$found_socket = array_search($socket, $changed);
				unset($changed[$found_socket]);
			}

			//loop through all connected sockets
			foreach ($changed as $changed_socket) {

				//check for any incomming data
				while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
				{
					//execute main logic
                    $this->main_logic($changed_socket, $buf);
					break 2; //exist this loop
				}

				$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
				if ($buf === false) { // check disconnected client
					// remove client for $clients array
					$found_socket = array_search($changed_socket, $this->clients);
					socket_getpeername($changed_socket, $ip);
					unset($this->clients[$found_socket]);
					//notify all users about disconnected connection
					//$response = mask(json_encode(array('type'=>'system', 'terminal'=>$ip.' disconnected')));
					//send_message($response);
				}
			}
		}
		// close the listening socket
		socket_close($socket);
	}

	private function send_message_all($msg){
		foreach($this->clients as $changed_socket)
		{
		    $this->send_message($changed_socket, $msg);
        }
		return true;
	}

    private function send_message($changed_socket, $msg){
        var_dump('message sent to: '. $changed_socket);
        @socket_write($changed_socket,$msg,strlen($msg));
    }

	//Unmask incoming framed message
	private function unmask($text){
		$length = ord($text[1]) & 127;
		if($length == 126) {
			$masks = substr($text, 4, 4);
			$data = substr($text, 8);
		}
		elseif($length == 127) {
			$masks = substr($text, 10, 4);
			$data = substr($text, 14);
		}
		else {
			$masks = substr($text, 2, 4);
			$data = substr($text, 6);
		}
		$text = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$text .= $data[$i] ^ $masks[$i%4];
		}
		return $text;
	}

	//Encode message for transfer to client.
	private function mask($text){
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($text);

		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$text;
	}

	//handshake new client.
	private function perform_handshaking($receved_header,$client_conn, $host, $port)
	{
		$headers = array();
		$lines = preg_split("/\r\n/", $receved_header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
			{
				$headers[$matches[1]] = $matches[2];
			}
		}

		$secKey = $headers['Sec-WebSocket-Key'];
		$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		//hand shaking header
		$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
			"Upgrade: websocket\r\n" .
			"Connection: Upgrade\r\n" .
			"WebSocket-Origin: $host\r\n" .
			"WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
			"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
		socket_write($client_conn,$upgrade,strlen($upgrade));
	}

    private function add_process_queue_client($client, $business_id, $service_id, $terminal_id){
		$this->delete_business_socket($client);
		var_dump('added new business socket' . $client);
		$this->business_clients[] = [
            'business_id' => $business_id,
            'service_id' => $service_id,
            'terminal_id' => $terminal_id,
            'client' => $client
        ];
	}

    private function update_business_sockets($business_id){
        foreach($this->business_clients as $client){
            if($client['business_id'] == $business_id){
                $numbers = ProcessQueue::allNumbers($client['service_id'], $client['terminal_id']);
                ProcessQueue::updateBusinessBroadcast($business_id);
                $response_text = $this->mask(json_encode(array('numbers' => $numbers, 'terminal_id' => $client['terminal_id'], 'service_id' => $client['service_id'])));
                $this->send_message($client['client'], $response_text); //send data
            }
        }
    }

	private function delete_business_socket($socket){
		foreach($this->business_clients as $key => $client){
			$found_socket = array_search($socket, $client);
			if($found_socket){
				unset($this->business_clients[$key]);
			}
		}
	}

	private function add_broadcast_client($client, $business_id){
		$this->delete_broadcast_socket($client);
		var_dump('added new broadcast socket' . $client);
		$this->broadcast_clients[] = [
			'business_id' => $business_id,
			'client' => $client
		];
	}

	private function update_broadcast_sockets($msg){
		foreach($this->broadcast_clients as $client){
			if($client['business_id'] == $msg->business_id){
				$number = $msg->number; //sender name
				$terminal = $msg->terminal; //message text
				$rank = $msg->rank; //color
				$box = $msg->box; //color

				$response_text = $this->mask(json_encode(array('type'=>'usermsg', 'number'=>$number, 'terminal'=>$terminal, 'rank'=>$rank, 'box'=>$box)));
				$this->send_message($client['client'], $response_text);
			}
		}
	}

	private function delete_broadcast_socket($socket){
		foreach($this->broadcast_clients as $key => $client){
			$found_socket = array_search($socket, $client);
			if($found_socket){
				unset($this->broadcast_clients[$key]);
			}
		}
	}

	private function main_logic($changed_socket, $buf){
		$received_text = $this->unmask($buf); //unmask data
		$msg = json_decode($received_text); //json decode

		//prepare data to be sent to client
		if(isset($msg->business_id) && isset($msg->terminal_id) && isset($msg->service_id)){
			$this->process_queue_logic($msg, $changed_socket);
		}else if(isset($msg->business_id) && isset($msg->number) && isset($msg->terminal) && isset($msg->rank) && isset($msg->box)){
			$this->broadcast_logic($msg, $changed_socket);
		}else{
			$response_text = $this->mask(json_encode($msg));
			$this->send_message($changed_socket, $response_text); //send data
		}
	}

	private function process_queue_logic($msg, $changed_socket){
		$business_id = $msg->business_id;
		$service_id = $msg->service_id;
		$terminal_id = $msg->terminal_id;

		$this->add_process_queue_client($changed_socket, $business_id, $service_id, $terminal_id);
		$this->update_business_sockets($business_id);
	}

	private function broadcast_logic($msg, $changed_socket){
		$this->add_broadcast_client($changed_socket, $msg->business_id);
		$this->update_broadcast_sockets($msg);
	}
}
