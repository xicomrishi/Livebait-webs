<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $plan_id
 * @property string $payment_data
 * @property int $status
 * @property int $user_id
 *
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\User $user
 */
class Payment extends Entity
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
        'modified' => true,
        'plan_id' => true,
        'payment_data' => true,
        'status' => true,
        'user_id' => true,
        'plan' => true,
        'user' => true
    ];
}
