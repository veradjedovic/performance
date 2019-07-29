<?php

namespace App\controllers;

use App\models\Client;
use Exception;
use App\exceptions\NotFoundException;

/**
 * Description of ClientController
 */
class ClientController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'index';

    /**
     * @var object
     */
    protected $client;


    /**
     * Construct
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get all clients
     *
     * @return view
     */
    public function index()
    {
        $data = $this->client->getAll();
        $this->view('index', ['data' => $data]);
    }

    /**
     * Insert method
     *
     * @return view
     */
    public function insert()
    {
        $this->view('insert');
    }

    /**
     * Insert data to database
     *
     * @return json
     */
    public function store()
    {
        try {
            $data = $this->client->insertClient();

            if($data['error']) {

                echo json_encode(['error' => $data['error'], 'message' => 'Error', 'success' => false]);

            } else {

                $message = 'Client ' . replace($data['data']->first_name) . ' ' .
                    replace($data['data']->last_name) . ' is successfully created. Street: ' .
                    replace($data['data']->street) . '. Postal code: ' .
                    replace($data['data']->postal) . '. City: ' .
                    replace($data['data']->city) . '. Country: ' .
                    replace($data['data']->country);
                    
                echo json_encode(['result' => $data['data'], 'message' => $message, 'success' => true]);
            }

        } catch (NotFoundException $ex) {

            echo json_encode(['message' => $ex->getMessage(), 'success' => false]);

        } catch (Exception $ex) {

            echo json_encode(['message' => "Error is happend, data  aren't inserted!", 'success' => false]);
        }

    }
}