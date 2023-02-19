<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tbl_payment';
    protected $primaryKey = 'payment_id';
    protected $allowedFields = ['payment_id', 'paper_id', 'paper_title', 'paper_authors', 'payment_type', 'payment_status', 'payment_description', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
