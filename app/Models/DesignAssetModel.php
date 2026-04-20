<?php

namespace App\Models;

use CodeIgniter\Model;

class DesignAssetModel extends Model
{
    protected $table = 'tbl_designasset';
    protected $primaryKey = 'designasset_id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'designasset_group',
        'designasset_key',
        'designasset_label',
        'designasset_label_en',
        'designasset_source',
        'designasset_directory',
        'designasset_file',
        'designasset_alt',
        'designasset_status',
        'designasset_sort',
    ];
    protected $validationRules = [
        'designasset_group' => 'required|max_length[100]',
        'designasset_key' => 'required|max_length[100]',
        'designasset_label' => 'required|max_length[200]',
        'designasset_source' => 'required|in_list[redesign,upload]',
        'designasset_directory' => 'permit_empty|max_length[120]',
        'designasset_file' => 'required|max_length[255]',
        'designasset_status' => 'permit_empty|in_list[0,1]',
        'designasset_sort' => 'permit_empty|integer',
    ];
}