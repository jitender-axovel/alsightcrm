<?php



App::uses('AppModel', 'Model');

/*

 * 

 * Company Model *

 * 

 */



class Company extends AppModel {

    /*

     *  

     * Primary key field

     * 

     * @var string

     */



    public $primaryKey = 'id';

    public $displayField = 'name';

    var $name = 'Company';

    var $hasMany = array(
        'Contact' => array(
            'dependent' => true
        )
    );

    /*

     * 

     *  Validation rules     *     * @var array     */


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