<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tbl_payment';
    protected $primaryKey = 'payment_id';
    protected $allowedFields = ['payment_id', 'paper_id', 'paper_title', 'paper_authors', 'paper_firstname', 'paper_lastname', 'payment_email', 'payment_phone', 'payment_type', 'payment_status', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
