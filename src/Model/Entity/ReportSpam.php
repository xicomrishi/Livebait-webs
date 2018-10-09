<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReportSpam Entity
 *
 * @property int $id
 * @property int $request_id
 * @property int $fromuser
 * @property int $touser
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Request $request
 */
class ReportSpam extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'request_id' => true,
        'fromuser' => true,
        'touser' => true,
        'created' => true,
        'modified' => true,
        'request' => true
    ];
}