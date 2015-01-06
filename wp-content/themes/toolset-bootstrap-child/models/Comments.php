<?php
/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 1/6/15
 * Time: 16:28
 */

class Comments {
    private $commentId;

    public function __construct($commentId){
        $this->commentId = $commentId;
    }


    /*
     * Return author Object
     */
    public function getCommenter(){
        return null;
    }


    /*
     * Return Number
     */
    public function getUpVoteCount(){
        return null;
    }


    /*
     * Return Array of WP User Objects
     */
    public function getWhoUpVoted(){
        return null;
    }


    /*
     * Return photo Object
     */
    public function getRelatedPhoto(){
        return null;
    }


    /*
     * Return Date/Time
     */
    public function getTimePosted(){
        return null;
    }


    /*
     * Return String
     */
    public function getCommenterPictureUrl(){
        return null;
    }


    /*
     * Return Array of Strings
     */
    public function getAuthorRoles(){
        return null;
    }
}