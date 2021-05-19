<?php

//Chat.php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
require dirname(__DIR__) . "/database/ChatUser.php";
require dirname(__DIR__) . "/database/PrivateChat.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo 'Server Started';
    }

    public function onOpen(ConnectionInterface $conn) {

        // Store the new connection to send messages to later
        echo 'Server Started';

        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        //echo $querystring;

        if(isset($queryarray['token']))
        {

            $user_object = new \ChatUser;

            $user_object->setUserToken($queryarray['token']);

            $user_object->setUserConnectionId($conn->resourceId);

            $user_object->update_user_connection_id();

            $user_data = $user_object->get_user_id_from_token();
            
            $user_id = $user_data['user_id'];

            $data['status_type'] = 'online';

            $data['user_id_status'] = $user_id;

            //$user_object->setUserId($user_id);

            //echo print_r($user_object->get_user_all_data_with_status_count());

            // first, you are sending to all existing users message of 'new'
            foreach ($this->clients as $client)
            {
                $client->send(json_encode($data)); //here we are sending a status-message
            }
        }

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        $data = json_decode($msg, true);

        if ($data['command'] == 'private') {
            //private chat

            $private_chat_object = new \PrivateChat;

            $private_chat_object->setToUserId($data['receiver_userid']);

            $private_chat_object->setFromUserId($data['userId']);

            $private_chat_object->setChatMessage($data['msg']);

            //$uploaded = $private_chat_object->upload_files($data['file']);

            //$private_chat_object->setUpload_file($uploaded[0]);

            //$private_chat_object->setImg_or_not($uploaded[1]);

            //$private_chat_object->setFilename($uploaded[2]);

            $timestamp = date('Y-m-d h:i:s');

            $private_chat_object->setTimestamp($timestamp);

            $private_chat_object->setStatus('No');

            $chat_message_id = $private_chat_object->save_chat();

            $user_object = new \ChatUser;

            $user_object->setUserId($data['userId']);

            $sender_user_data = $user_object->get_user_data_by_id();

            $user_object->setUserId($data['receiver_userid']);

            $receiver_user_data = $user_object->get_user_data_by_id();

            $sender_user_name = $sender_user_data['username'];

            $data['datetime'] = $timestamp;

            $receiver_user_connection_id = $receiver_user_data['user_connection_id'];
            /*
            foreach($sender_user_data as $key=>$value){
                echo sprintf("The data inside is: %d" . "\n", $value[$key]);
            }
*/
            //echo print_r($receiver_user_data);

            foreach ($this->clients as $client) {
                if ($from == $client) {
                    $data['from'] = 'Me';
                } else {
                    $data['from'] = $sender_user_name;
                }
                echo sprintf(
                    'Client resource ID is %d. Receiver connection_id is %d.' . "\n",
                    $client->resourceId,
                    $receiver_user_connection_id
                );

                if ($client->resourceId == $receiver_user_connection_id || $from == $client) {
                    $client->send(json_encode($data));
                    
                } else {
                    $private_chat_object->setStatus('No');
                    $private_chat_object->setChatMessageId($chat_message_id);
                    $private_chat_object->update_chat_status();
                    //$client->send(json_encode($data));
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if(isset($queryarray['token']))
        {

            $user_object = new \ChatUser;

            $user_object->setUserToken($queryarray['token']);

            $user_data = $user_object->get_user_id_from_token();

            $user_id = $user_data['user_id'];

            $user_object->setUserId($user_id);
            echo "Connection onclose above all status count";

            echo print_r($user_object->get_user_all_data_with_status_count());

            $data['status_type'] = 'Offline';

            $data['user_id_status'] = $user_id;

            foreach($this->clients as $client)
            {
                $client->send(json_encode($data));
            }
        }
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

?>