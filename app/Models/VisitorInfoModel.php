<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorInfoModel extends Model
{
    protected $table = 'tbl_visitvisitorinfo';
    protected $primaryKey = 'visitorinfo_id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'visitorinfo_section',
        'visitorinfo_title',
        'visitorinfo_title_en',
        'visitorinfo_label',
        'visitorinfo_label_en',
        'visitorinfo_desc',
        'visitorinfo_desc_en',
        'visitorinfo_icon',
        'visitorinfo_image',
        'visitorinfo_sort',
        'visitorinfo_status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $useSoftDeletes = false;

    protected $validationRules = [
        'visitorinfo_section' => 'required|in_list[rule,learn]',
        'visitorinfo_title' => 'required|max_length[255]',
        'visitorinfo_desc' => 'required',
        'visitorinfo_sort' => 'permit_empty|integer',
        'visitorinfo_status' => 'permit_empty|in_list[0,1]',
    ];

    protected $skipValidation = false;
}
