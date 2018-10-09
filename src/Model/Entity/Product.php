<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $name
 * @property int $no_of_chats
 * @property string $modified
 * @property float $price
 */
class Product extends Entity
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
        'created' => true,
        'name' => true,
        'no_of_chats' => true,
        'modified' => true,
        'price' => true
    ];
}
