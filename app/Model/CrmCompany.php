<?php



App::uses('AppModel', 'Model');

/*

 * 

 * Company Model *

 * 

 */



class CrmCompany extends AppModel {

    /*

     *  

     * Primary key field

     * 

     * @var string

     */



    public $primaryKey = 'id';

    public $displayField = 'company_name';

    var $name = 'CrmCompany';

    var $hasMany = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => 'crm_company_id',
            'dependent' => true
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'crm_company_id',
            'dependent' => true
        )
    );

    /*

     * 

     *  Validation rules     *     * @var array     */

    public $validate = array(

        'Company_Name' => array(

            'notEmpty' => array(

                'rule' => array(

                    'notEmpty'

                ),

                'message' => 'It is mendatory to specify company name.',

            /* 'allowEmpty' => false, */

                'required' => true

            /* 'last' => false, */

            // Stop validation after this rule

            //'on' => 'create',

            // Limit validation to 'create' or 'update' operations

            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This company name already exists'
            ),

        ),

        'Company_Domain' => array(

            'nonEmpty' => array(

                'rule' => array(

                    'notEmpty'

                ),

                'message' => 'It is mendatory to specify Domain.',

            //'allowEmpty' => false,

                'required' => true

            //'last' => false,

            // Stop validation after this rule

            //'on' => 'create', 

            // Limit validation to 'create' or 'update' operations 

            ),

            'pattern' => array(

                'rule' => '/^(([a-zA-Z]{1})|([a-zA-Z]{1}[a-zA-Z]{1})|([a-zA-Z]{1}[0-9]{1})|([0-9]{1}[a-zA-Z]{1})|([a-zA-Z0-9][a-zA-Z0-9-_]{1,61}[a-zA-Z0-9]))\.([a-zA-Z]{2,6}|[a-zA-Z0-9-]{2,30}\.[a-zA-Z]{2,3})$/',

                'message' => 'Enter a valid domain'

            )

        ),
        'Company_Group' => array(

            'notEmpty' => array(

                'rule' => array(

                    'notEmpty'

                ),

                'message' => 'It is mendatory to specify company group.',

            /* 'allowEmpty' => false, */

                'required' => true

            /* 'last' => false, */

            // Stop validation after this rule

            //'on' => 'create',

            // Limit validation to 'create' or 'update' operations

            )
            ),

    );



    /*

     * * Create a hash from string using given method.

     * Fallback on next available method.

     * 

     * Override this method to use a different hashing method

     * 

     * @param string $string String to hash

     * @param string $type Method to use (sha1/sha256/md5)

     * @param boolean $salt If true, automatically appends the application's salt

     * 

     * value to $string (Security.salt)

     * @return string Hash 

     */



    public function hash($string, $type = null, $salt = false) {

        return Security::hash($string, $type, $salt);

    }



}

?>