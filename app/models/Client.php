<?php

namespace App\models;

use App\exceptions\NotFoundException;
use App\classes\Validator;

/**
 * Description of Client
 */
class Client extends ActiveRecord
{
    /**
     * @var mixed
     */
    public $id, $first_name, $last_name, $street, $postal, $city, $country;

    /**
     * @var string
     */
    public static $table = "clients";

    /**
     * @var string
     */
    public static $id_column = "id";

    /**
     * @var object
     */
    private $validator;


    /**
     * Construct
     */
    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * insert a new client
     */
    public function insertClient()
    {
        if(!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['street']) || !isset($_POST['postal']) || !isset($_POST['city']) || !isset($_POST['country'])) {
            throw new NotFoundException('Invalid data.');
        }

        $error = [];

        if($this->validator->Required($_POST['first_name'])['error']) {
            $error['first_name'][0] = $this->validator->Required($_POST['first_name'])['error'];
        } else {
            $this->first_name = $this->validator->Required($_POST['first_name'])['data'];
        }

        if($this->validator->Required($_POST['last_name'])['error']) {
            $error['last_name'][0] = $this->validator->Required($_POST['last_name'])['error'];
        } else {
            $this->last_name = $this->validator->Required($_POST['last_name'])['data'];
        }

        if($this->validator->Required($_POST['street'])['error']) {
            $error['street'][0] = $this->validator->Required($_POST['street'])['error'];
        } else {
            $this->street = $this->validator->Required($_POST['street'])['data'];
        }

        if($this->validator->Numeric($_POST['postal'])['error']) {
            $error['postal'][0] = $this->validator->Numeric($_POST['postal'])['error'];
        } else {
            $this->postal = $this->validator->Numeric($_POST['postal'])['data'];
        }

        if($this->validator->Required($_POST['city'])['error']) {
            $error['city'][0] = $this->validator->Required($_POST['city'])['error'];
        } else {
            $this->city = $this->validator->Required($_POST['city'])['data'];
        }

        if($this->validator->Required($_POST['country'])['error']) {
            $error['country'][0] = $this->validator->Required($_POST['country'])['error'];
        } else {
            $this->country = $this->validator->Required($_POST['country'])['data'];
        }

        
        if (count($error) > 0) {
            return ['data' => false, 'error' => $error];
        } else {
            $this->id = $this->insert();
            return ['data' => $this, 'error' => false];
        }
    }
}