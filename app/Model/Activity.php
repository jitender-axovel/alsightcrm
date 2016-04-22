<?php

App::uses('AppModel', 'Model');

/**
 * Activity Model *
 */
class Activity extends AppModel {

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * Validation rules
     *
     * @var array
     */ //public $validate = array(
        //'Notification_Time' => array(
            //'datetime' => array(
                //'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false,
            // Stop validation after this rule
            //'on' => 'create',
            // Limit validation to 'create' or 'update' operations
            //),
        //),
    //);
    var $name = 'Activity';
    public $belongsTo = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => 'contact_id'
        ),
        'Opportunity' => array(
            'className' => 'Opportunity',
            'foreignKey' => 'opportunity_id'
        )
    );

}

?>