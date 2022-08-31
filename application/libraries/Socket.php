<?php
    use ElephantIO\Client;
    use ElephantIO\Engine\SocketIO\Version2X;
    
    require FCPATH . 'vendor/autoload.php';

    class Socket {

        public function send($target, $params) { // 'izin', '{room=>"123456"}'
            $this->_ci = &get_instance();
            $this->socket_server = $this->_ci->config->item('socket_server');

            $url = $this->socket_server;
            $client = new Client(new Version2X($url, [
                'headers' => [
                    'X-My-Header: websocket rocks',
                    'Authorization: Bearer 12b3c4d5e6f7g8h9i'
                ],
                'context' => [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ]
                ]
            ]));

            $client->initialize();
            $client->emit($target, $params);
            $client->close();
            return true;
        }
    }